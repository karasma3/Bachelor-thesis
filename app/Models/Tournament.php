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
        return $this->hasMany(Group::class);
    }

    public function teams(){
        return $this->belongsToMany( Team::class);
    }
    public function isCreated(){
        if("created" == $this->phase) return true;
        return false;
    }
    public function isGroupStage(){
        if("group_stage" == $this->phase) return true;
        return false;
    }

    public function getState()
    {
        switch ($this->phase) {
            case 'group_stage': return "Skupinová časť";
            case 'elimination_stage': return "Vyraďovacia časť";
            case 'closed': return "Ukončený";
            default: return "Registrácia";
        }
    }
    public function generateGroups()
    {
        //delete if previously generated
        $group_ids = DB::table('groups')->select('id')->where('tournament_id', '=', $this->id)->get()->toArray();
        foreach ($group_ids as $group_id) {
            DB::table('matches')->where('group_id', '=', $group_id->id)->delete();
        }
//        DB::table('groups')->select('id')->where('tournament_id', '=', $tournament->id)->delete();
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
                'group_name' => $group_name
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
