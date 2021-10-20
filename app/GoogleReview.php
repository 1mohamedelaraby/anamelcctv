<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleReview extends Model
{
    protected $fillable = [
        'author_name',
        'author_url',
        'profile_photo_url',
        'rating',
        'text',
        'time',
        'status',
    ];
}
