<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

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

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
