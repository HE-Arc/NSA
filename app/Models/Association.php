<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'description'];

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    public function subscribers()
    {
        return $this->belongsToMany("App\Models\User", 'subscriptions');
    }
}
