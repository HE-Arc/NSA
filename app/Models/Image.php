<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        if (Storage::disk('public')->delete('/uploads/images/'.$image->storage_name)) {
            $image->delete();
        }
    }

    public static function uploadImage(UploadedFile $file)
    {
        $image = new Image();

        $imageMimeType = $file->getMimeType();
        $imageFullName = $file->getClientOriginalName();
        $imageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $imageExtension = $file->getClientOriginalExtension();

        $storingImageName = Str::slug($imageName.'_'.time()).'.'.$imageExtension;

        $path = $file->storeAs('uploads/images', $storingImageName, 'public');

        $image->src = '/storage/'.$path;
        $image->storage_name = $storingImageName;
        $image->title = $imageFullName;
        $image->alt = $imageName;
        $image->mime_type = $imageMimeType;

        $image->save();

        return $image->id;
    }
}
