<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Association;
use App\Http\Requests\CreateAssociation;

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
            return redirect()->back()->withErrors('You can\'t edit those associations');
        }
    }

    public function update(CreateAssociation $request, Association $association)
    {
        //dd($association);
        $request->validate($request->rules());
        $association->update($request->all());

        return redirect()->route('associations.index')->with('success', 'Association updated successfully.');
    }

    public function destroy(Association $association)
    {
        $association->delete();

        return redirect()->route('associations.index')->with('success', 'Association deleted successfully');
    }

    public function store(CreateAssociation $request)
    {
        $request->validate($request->rules());

        $user = auth()->user();
        $userID = $user->id;

        $association = new Association;
        $association->name = $request->name;
        $association->email = $request->email;
        $association->description = $request->description;
        $association->user_id = $userID;
        $association->save();

        return redirect()->back()->with('success', 'Association has been added successfully.');
    }
}
