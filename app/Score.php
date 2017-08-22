<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'status', 'note'
    ];

    static public function getTotalScore($user_id)
    {
        $scores = self::where('user_id', $user_id)->get();

        $nbScore = count($scores);

        $total = self::getTotalNote($scores, $nbScore);

        return ['total' => $total, 'nb' => $nbScore];
    }

    static private function getTotalNote($scores, $nb)
    {
        $total = 0;

        foreach($scores as $score) {
            $total += intval($score["note"]);
        }

        return ($total * 100) / ($nb * 100);
    }
}
