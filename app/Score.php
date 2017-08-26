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
        $points = self::where('user_id', $user_id)->sum("note");
        $nb = self::where('user_id', $user_id)->count();

        $total = $nb ? ($points * 100) / ($nb * 100) : 0;

        return ['total' => $total, 'nb' => $nb];
    }
}
