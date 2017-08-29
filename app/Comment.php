<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'title', 'content', 'status'
        ];

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
}
