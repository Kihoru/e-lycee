<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
