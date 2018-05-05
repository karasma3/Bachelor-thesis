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
        $teams = DB::table('group_team')->select('team_id')->where('group_id',$this->id)->orderByRaw('points DESC, score_won DESC, score_lost')->get();
        $ordering = 0;
        foreach ($teams as $team){
            $ordering++;
            DB::table('group_team')->where([['group_id', $this->id],['team_id',$team->team_id]])->update(['ordering' => $ordering]);
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
    public function findMatch($team1, $team2){
        return Match::where([['team_id_first','=',$team1],['team_id_second','=',$team2]])->orWhere([['team_id_first','=',$team2],['team_id_second','=',$team1]])->get();
    }
}
