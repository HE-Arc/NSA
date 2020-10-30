<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivity;
use App\Models\Activity;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

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

        if ($request->image) {
            if ($request->image->isValid()) {
                $activity->image_id = Image::uploadImage($request->image);
            }
        }

        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Activity has been added successfully.');
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

        if ($request->image) {
            if ($request->image->isValid()) {
                Image::destroyAndDelete($activity->image_id);
                $activity->image_id = Image::uploadImage($request->image);
            }
        }

        $activity->update();

        return redirect()->route('activities.index')->with('success', 'Activity has been updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        $image = Image::findOrFail($activity->id);

        if (Storage::disk('public')->delete('/uploads/images/'.$image->storage_name)) {
            $activity->delete();
        }

        return redirect()->route('activities.index')->with('success', 'Activity has been deleted successfully.');
    }
}
