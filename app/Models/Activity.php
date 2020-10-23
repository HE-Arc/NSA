<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function image()
    {
        return $this->belongsTo(Image::class,'image_id');
    }

    public function participants()
    {
        return $this->belongsToMany('App\Models\User', 'participations');
    }
}
