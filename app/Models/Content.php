<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    
    protected $guarded = ['id'];
    protected static function booted(){
        static::creating(function ($content) {
            if (is_null($content->order)) {
                $lastOrder = Content::where('course_id', $content->course_id)
                                ->max('order');
                $content->order = $lastOrder ? $lastOrder + 1 : 1;
            }
        });
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }
    public function contentable(){
        return $this->morphTo();
    }
}
