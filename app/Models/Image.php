<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'src', //the path you uploaded the image
        'mime_type',
        'alt',
    ];

    public static function destroyAndDelete($id)
    {
        $image = Image::findOrFail($id);

        error_log($image->storage_name);

        if(Storage::disk('public')->delete('/uploads/images/' . $image->storage_name))
        {
           $image->delete();

        }
    }
}
