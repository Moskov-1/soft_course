<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = "levels";
    protected $guarded = ['id', 'created_at','updated_at'];
}
