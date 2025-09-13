<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function modules(){
        return $this->hasMany(Module::class);
    }
    
    
}
