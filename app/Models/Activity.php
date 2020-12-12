<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function participants()
    {
        return $this->belongsToMany('App\Models\User', 'participations');
    }

    public function getWrappedBigDesc()
    {
        return $this->getWrappedDesc(1000);
    }

    public function getWrappedTinyDesc()
    {
        return $this->getWrappedDesc(200);
    }

    public function getWrappedDesc($maxLen)
    {
        $descLen = strlen($this->description);
        if ($descLen > $maxLen) {//more than
            return substr($this->description, 0, $maxLen).'...';
        }

        return $this->description;
    }
}
