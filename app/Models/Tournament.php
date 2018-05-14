<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class Tournament
 *
 * @package App\Models
 */
class Tournament extends Model
{
    const GROUP_NAME = 'A';
    const GROUP_STAGE = 'group_stage';
    public function groups(){
        return $this->hasMany(Group::class)->where('round','=',0);
    }
    public function groupsInRandomOrder(){
        return $this->hasMany(Group::class)->where('round','=',0)->inRandomOrder();
    }
    public function brackets(){
        return $this->hasMany(Group::class)->where('round','>',0);
    }
    public function firstRoundBracket(){
        return $this->hasMany(Group::class)->where('round','=',1);
    }
    public function teamsInEliminationStage(){
        return $this->belongsToMany( Team::class) -> where('elimination_stage', '=', true);
    }
    public function matchesInBracket($brackets){
        $matches = collect();
        foreach ($brackets as $bracket) {
            foreach ($bracket->matches as $match) {
                $matches->push($match);
            }
        }
        $matches = $matches->sortBy(function($match){
            return $match->match_number;
        });
        return $matches;
    }
    public function teams(){
        return $this->belongsToMany( Team::class);
    }
    public function isCreated(){
        if('created' == $this->phase) return true;
        return false;
    }
    public function isGroupStage(){
        if('group_stage' == $this->phase) return true;
        return false;
    }
    public function isEliminationStage(){
        if('elimination_stage' == $this->phase) return true;
        return false;
    }
    public function isClosed(){
        if('closed' == $this->phase) return true;
        return false;
    }
    public function getState()
    {
        switch ($this->phase) {
            case 'group_stage': return 'Skupinová časť';
            case 'elimination_stage': return 'Vyraďovacia časť';
            case 'closed': return 'Ukončený';
            default: return 'Registrácia';
        }
    }
    public function generateGroups()
    {
        //delete if previously generated
        $group_ids = DB::table('groups')->select('id')->where('tournament_id', '=', $this->id)->get()->toArray();
        foreach ($group_ids as $group_id) {
            DB::table('matches')->where('group_id', '=', $group_id->id)->delete();
        }
        $this->groups()->delete();
        //deciding on game system
        $sum_teams = count($this->teams);
        if($sum_teams >= 8 and $sum_teams <= 16){
            $sum_groups = 2;
        }else if($sum_teams > 16 and $sum_teams <= 32){
            $sum_groups = 4;
        }else if($sum_teams > 32){
            $sum_groups = 8;
        }else{
            //less than 8
            $this->phase = 'closed';
            $this->save();
            session()->flash('fail','Neprihlásilo sa aspoň 8 tímov. Turnaj bol ukončený!');
            return;
        }
        //seeding into groups
        $team_ids = DB::table('team_tournament')->select('team_id')->where('tournament_id', $this->id)->orderBy('last_placement')->get()->toArray();
        $groups = [[]];
        for($i=0;$i<$sum_groups-1;$i++){
            array_push($groups, $tmp_teams=[]);
        }
        $i=0;
        foreach($team_ids as $team) {
            array_push($groups[$i],$team);
            $i++;
            if($i == $sum_groups){
                $i=0;
            }
        }
        //create groups
        $group_name = self::GROUP_NAME;
        foreach ($groups as $group){
            $new_group = Group::create([
                'tournament_id' => $this->id,
                'group_name' => $group_name,
                'round' => 0
            ]);
            $group_name++;
            foreach ($group as $team){
                $new_group->teams()->save(Team::find($team->team_id));
            }
            //create matches
            $new_group->generateMatches();
        }
        $this->phase = self::GROUP_STAGE;
        $this->save();
        session()->flash('message','Skupiny boli vytvorené!');
    }
    public function createBracket(){
        $bracket = Group::create([
            'tournament_id' => $this->id,
            'group_name' => 'Kolo: 1',
            'round' => 1
        ]);
        $i=0;
        $match_number=1;
        $groups = $this->groupsInRandomOrder;
        foreach ($groups as $group1){
            $winners1 = $group1->getWinners();
            $j=0;
            foreach ($winners1 as $team1){
                if($team1->matched){
                    $j++;
                    continue;
                }
                $k=0;
                foreach ($groups as $group2){
                    if($i==$k){
                        $k++;
                        continue;
                    }
                    $winners2 = $group2->getWinners();
                    $l=0;
                    foreach ($winners2 as $team2){
                        if($j+$l==3 and $team1->matched==false and $team2->matched==false){
                            $score = Score::create([
                            ]);
                            Match::create([
                                'score_id' => $score->id,
                                'group_id' => $bracket->id,
                                'team_id_first' => $team1->id,
                                'team_id_second' => $team2->id,
                                'match_number' => $match_number
                            ]);
                            $match_number++;
                            $team1->matched = true;
                            DB::table('team_tournament')->where([['team_id', $team1->id],['tournament_id', $this->id]])->update(['elimination_stage' => true]);
                            $team1->save();
                            $team2->matched = true;
                            DB::table('team_tournament')->where([['team_id', $team2->id],['tournament_id', $this->id]])->update(['elimination_stage' => true]);
                            $team2->save();
                            if(!$bracket->findTeam($team1->id)) {
                                $bracket->teams()->save($team1);
                            }
                            if(!$bracket->findTeam($team2->id)) {
                                $bracket->teams()->save($team2);
                            }
                        }
                        $l++;
                    }
                    $k++;
                }
                $j++;
            }
            $i++;
        }
        $this->phase='elimination_stage';
        $this->save();
        session()->flash('message','Pavúk bol vytvorený!');
    }
    public function nextRound(){
        $last_round = Group::find(Group::select('id')->where('tournament_id',$this->id)->orderBy('round','desc')->first())->first();
        foreach ($last_round->matches as $match){
            if(!$match->played){
                session()->flash('fail','Všetky zápasy musia byť odohrané!');
                return;
            }
        }
        $next_round = Group::create([
            'tournament_id' => $this->id,
            'round' => $last_round->round + 1,
            'group_name' => 'Kolo: '.($last_round->round+1)
        ]);
        $next_round->generateMatchesInBracket($last_round);
        session()->flash('message','Ďalšie kolo bolo vytvorené!');
    }
    /**
     * Method for getting Tournaments from the Database
     *
     * @return mixed
     */
    public static function archives(){
        return static::selectRaw('tournament_name, id, count(*) as t_name')
            ->groupBy('tournaments.tournament_name', 'id')
            ->orderBy('tournaments.tournament_name')
            ->get();
    }
}
