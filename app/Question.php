<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question'
    ];

    public function choice()
    {
        return $this->hasMany('App\Choice');
    }
}
