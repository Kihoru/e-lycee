<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'abstract', 'content', 'url_thumbnail', 'status'
    ];

    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    public function allPost()
    {
    	return $this->with('comments')->get();
    }

    public function getLasts($nb)
    {
        return $this->orderBy('id', 'desc')->take($nb)->get();
    }
}
