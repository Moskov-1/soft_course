<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $guarded = ['id'];
    protected static function booted(){
        static::creating(function ($module) {
            if (is_null($module->order)) {
                $lastOrder = Module::where('course_id', $module->course_id)
                                ->max('order');
                $module->order = $lastOrder ? $lastOrder + 1 : 1;
            }
        });
    }
}
