<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $fillable = [
        'user_id', 'like', 'dislike',
    ];

    protected $casts = [
    	'like' => 'boolean',
	    'dislike' => 'boolean',
	];

}
