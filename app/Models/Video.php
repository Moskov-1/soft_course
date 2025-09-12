<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


}
