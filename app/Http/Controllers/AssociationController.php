<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssociation;
use App\Models\Association;
use Illuminate\Support\Facades\Auth;

class AssociationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $associations = Association::all();

        return view('associations.index', ['associations' => $associations]);
    }

    public function create()
    {
        return view('associations.create');
    }

    public function show(Association $association)
    {
        return view('associations.show', compact('association'));
    }

    public function edit(Association $association)
    {
        $user = auth()->user();
        $userID = $user->id;

        if ($association->user_id == $userID) {
            return view('associations.edit', compact('association'));
        } else {
            return redirect()->back()->withErrors('You cannot edit these associations.');
        }
    }

    public function update(CreateAssociation $request, Association $association)
    {
        $request->validate($request->rules());
        $association->update($request->all());

        return redirect()->route('associations.index')->with('success', 'Association has been updated successfully.');
    }

    public function destroy(Association $association)
    {
        $user = auth()->user();
        $userID = $user->id;

        if($userID == $association->user_id) {
            $association->delete();
            return redirect()->route('associations.index')->with('success', 'Association has been deleted successfully.');
        }
        else {
            return redirect()->back()->withErrors('You cannot delete this association.');
        }
        
    }

    public function store(CreateAssociation $request)
    {
        $request->validate($request->rules());

        $user = auth()->user();
        $userID = $user->id;

        $association = new Association();
        $association->name = $request->name;
        $association->email = $request->email;
        $association->description = $request->description;
        $association->user_id = $userID;
        $association->save();

        return redirect()->route('associations.index')->with('success', 'Association has been added successfully.');
    }
}
