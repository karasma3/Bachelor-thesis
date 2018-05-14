<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;


/**
 * Class Group
 *
 * @package App\Models
 */
class Group extends Model
{
    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }
    public function teams(){
        return $this->belongsToMany(Team::class);
    }
    public function matches(){
        return $this->hasMany(Match::class);
    }
    public function matchesInOrder(){
        return $this->hasMany(Match::class)->orderBy('match_number');
    }
    public function calculateScore()
    {
        foreach ($this->teams as $team){
            $points = 0;
            $score_won = 0;
            $score_lost = 0;
            foreach ($team->matches as $match){
                if($match->group_id != $this->id) continue;
                if($match->team_id_first == $team->id){
                    $score_won += $match->scoreFirst();
                    $score_lost += $match->scoreSecond();
                    if($match->wonFirst()) {
                        $points += 1;
                    }
                }
                if($match->team_id_second == $team->id){
                    $score_lost += $match->scoreFirst();
                    $score_won += $match->scoreSecond();
                    if($match->wonSecond()) {
                        $points += 1;
                    }
                }
            }
            DB::table('group_team')->where([['group_id', $this->id],['team_id',$team->id]])->update(['points' => $points, 'score_won'=>$score_won, 'score_lost'=>$score_lost]);
        }
    }
    public function showOrdering(){
        foreach ($this->teams as $team){
            if($team->buildScore($this->id)!="0:0"){
                return true;
            }
        }
        return false;
    }
    public function calculateOrder(){
        $teams = DB::table('group_team')->select('team_id', 'points', 'score_won', 'score_lost')->where('group_id',$this->id)->orderByRaw('points DESC, score_won DESC, score_lost')->get();
        $ordering = 0;
        $skip=0;
        $tmp_team = null;
        foreach ($teams as $team){
            if($tmp_team){
                if($tmp_team->points==$team->points and $tmp_team->score_won==$team->score_won and $tmp_team->score_lost==$team->score_lost){
                    $skip++;
                    DB::table('group_team')->where([['group_id', $this->id],['team_id',$team->team_id],])->update(['ordering'=>$ordering]);
                    $tmp_team = $team;
                    continue;
                }
                else{
                    $skip=0;
                }
            }
            $ordering+=$skip+1;
            DB::table('group_team')->where([['group_id', $this->id],['team_id',$team->team_id]])->update(['ordering' => $ordering]);
            $tmp_team = $team;
        }
    }
    public function generateMatches(){
        foreach ($this->teams as $team_one){
            foreach ($this->teams as $team_two){
                $first_id = min($team_one->id,$team_two->id);
                $second_id = max($team_one->id,$team_two->id);
                if($first_id!=$second_id){
                    if(!Match::where([['team_id_first', '=', $first_id],['team_id_second', '=', $second_id]])->exists()) {
                        $score = Score::create([
                        ]);
                        $match = Match::create([
                            'team_id_first' => $first_id,
                            'team_id_second' => $second_id,
                            'group_id' => $this->id,
                            'score_id' => $score->id
                        ]);
                    }
                }
            }
        }
        //return $groupController->generateMatches($this);
    }
    public function generateMatchesInBracket($last_round){
        $match_number = $last_round->matches->max('match_number')+1;
        $tmp_match = null;
        $i=0;
        if($last_round->matches->count()==2){
            $this->is_finale = true;
            $this->save();
        }
        foreach($last_round->matches as $match){
            if($tmp_match){
                if($i % 2 != 0){
                    $score = Score::create([
                    ]);
                    Match::create([
                        'score_id' => $score->id,
                        'group_id' => $this->id,
                        'team_id_first' => $tmp_match->getWinnerId(),
                        'team_id_second' => $match->getWinnerId(),
                        'match_number' => $match_number
                    ]);
                    $match_number++;
                    if($this->is_finale){
                        $score = Score::create([
                        ]);
                        Match::create([
                            'score_id' => $score->id,
                            'group_id' => $this->id,
                            'team_id_first' => $tmp_match->getLoserId(),
                            'team_id_second' => $match->getLoserId(),
                            'match_number' => $match_number
                        ]);
                        $match_number++;
                    }
                }
            }

            $tmp_match = $match;
            $i++;
        }
    }
    public function findTeam($team_id){
        return DB::table('group_team')->select('team_id')->where([['group_id',$this->id],['team_id',$team_id]])->first();
    }
    public function findMatch($team1, $team2){
        return Match::where([['team_id_first','=',$team1],['team_id_second','=',$team2]])->orWhere([['team_id_first','=',$team2],['team_id_second','=',$team1]])->get();
    }
    public function isGroup(){
        if($this->round==0){
            return true;
        }
        return false;
    }
    public function getWinners(){
        $winners = [];
        $teams = DB::table('group_team')->select('team_id', 'ordering')->where('group_id', $this->id)->orderBy('ordering')->get();
        foreach ($teams as $team){
            if($team->ordering>0 and $team->ordering<=4){
                array_push($winners,Team::find($team->team_id));
            }
        }
        return $winners;
    }
}
