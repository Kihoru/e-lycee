<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qcm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'class_level'
    ];

    public function question()
    {
        return $this->hasMany('App\Question');
    }
}
