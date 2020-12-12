<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    protected $fillable = ['activity_id', 'user_id'];

    //so when saved there's not columns `updated_at`, `created_at`
    public $timestamps = false;
}
