<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivity;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Activity;
use App\Models\Image;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    public function index()
    {
        return view('activities.index');
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(CreateActivity $request)
    {
        $request->validate($request->rules());

        $activity = new Activity();
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->location = $request->location;
        $activity->date = $request->date;

        //TODO : potentially improve this required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000

        if ($request->image) {
            if ($request->image->isValid()) {
                $activity->image_id = $this->uploadImage($request->image);
            }
        }

        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Activity created successfully');
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(CreateActivity $request, Activity $activity)
    {
        $request->validate($request->rules());

        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->location = $request->location;
        $activity->date = $request->date;

        if ($request->image)
        {
            if ($request->image->isValid())
            {
                Image::destroyAndDelete($activity->image_id);
                $activity->image_id = $this->uploadImage($request->image);
            }
        }

        $activity->update();

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('associations.index')->with('success', 'Association deleted successfully');
    }

    public function uploadImage(UploadedFile $file)
    {
        $image = new Image();

        $imageMimeType = $file->getMimeType();
        $imageFullName = $file->getClientOriginalName();
        $imageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $imageExtension = $file->getClientOriginalExtension();

        $storingImageName = Str::slug($imageName . '_' . time()) . '.' . $imageExtension;

        $path = $file->storeAs('uploads/images', $storingImageName, 'public');

        $image->src = '/storage/' . $path;
        $image->storage_name = $storingImageName;
        $image->title = $imageFullName;
        $image->alt = $imageName;
        $image->mime_type = $imageMimeType;

        $image->save();

        return $image->id;
    }
}
