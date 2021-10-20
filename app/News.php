<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['image'];

    public function visits()
    {
        return visits($this)->relation();
    }

    public function scopeRandom($query, $limit = 6)
    {
        return $query->inRandomOrder()->limit($limit)->get();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->withResponsiveImages()
            ->singleFile();

        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->nonOptimized();
    }
}
