<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
class Video extends Model
{
    protected $guarded = ['id'];
    const SOURCES = [
        'youtube',
        'vimeo',
        'cloudinary',
        'local',
    ];

    public static function isValidSource(string $source): bool
    {
        return in_array($source, self::SOURCES, true);
    }
    
    public function getDurationAttribute(): string
    {
        return gmdate("H:i:s", $this->length_in_seconds);
    }

    public function content(): MorphOne{
        return $this->morphOne(Content::class, 'contentable');
    }

}
