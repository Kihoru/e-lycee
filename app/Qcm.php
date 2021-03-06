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

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function allQcm()
    {
        return $this->with('questions.choices')->get();
    }

    public function getOne($id)
    {
        return $this->with('questions.choices')->find($id);
    }

    public function getLasts($nb)
    {
        return $this->orderBy('id', 'desc')->take($nb)->get();
    }
}
