<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivity;
use App\Models\Activity;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $filter = null;
        $activities = null;
        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        } else {
            $filter = 'all';
        }

        switch ($filter) {
            case 'all':
                $activities = Activity::all();
            break;
            case 'today':
                $activities = Activity::whereDate('date', Carbon::today())->get();
            break;
            case 'date':
                if (isset($_GET['date'])) {
                    try {
                        $activities = Activity::whereDate('date', Carbon::parse($_GET['date']))->get();
                        if (count($activities) == 0) {
                            return redirect()->back()->withErrors('No activities for the selected date !');
                        }
                    } catch (\Exception $e) {
                        return redirect()->back()->withErrors('Date format not valide !');
                    }
                } else {
                    return redirect()->back()->withErrors('Date format not valide !');
                }
            break;
            default:
                $activities = Activity::all();
        }

        return view('activities.index', ['activities' => $activities]);
    }

    public function create()
    {
        $user = Auth::user();
        $userAssociations = $user->associations->sortBy('name'); //Retrieving sorted by name, so we can display sorted as well

        if (!$userAssociations->count()) {
            return redirect()->route('activities.index')->withErrors('You must possess at least one association to access this page.');
        } else {
            return view('activities.create', compact('userAssociations'));
        }
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    public function store(CreateActivity $request)
    {
        $request->validate($request->rules());

        $activity = new Activity();
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->location = $request->location;
        $activity->date = $request->date;
        $activity->association_id = $request->association_id;

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
        $user = Auth::user();
        $userAssociations = $user->associations->sortBy('name'); //Retrieving sorted by name, so we can display sorted as well

        return view('activities.edit', compact('activity', 'userAssociations'));
    }

    public function update(CreateActivity $request, Activity $activity)
    {
        $request->validate($request->rules());

        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->location = $request->location;
        $activity->date = $request->date;

        if ($request->image) {
            if (!is_null($activity->image_id)) {
                Image::destroyAndDelete($activity->image_id);
            }
            if ($request->image->isValid()) {
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
