<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Association;
use App\Http\Requests\CreateAssociation;

class AssociationController extends Controller
{
    public function index()
    {
        $associations = Association::all();

        return view('associations.index', ['associations' => $associations]);
    }

    public function create()
    {
        return view('associations.create');
    }

    public function store(CreateAssociation $request)
    {

        $user = auth()->user();
        $userID = $user->id;

        $association = new Association;
        $association->name = $request->name;
        $association->email = $request->email;
        $association->description = $request->description;
        $association->user_id = $userID;
        $association->save();

        return redirect()->back()->with('success','Association has been added successfully.');

    }
}
