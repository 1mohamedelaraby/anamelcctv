<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    protected $guarded = [];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
