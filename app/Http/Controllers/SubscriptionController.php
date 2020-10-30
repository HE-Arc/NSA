<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;

use App\Http\Requests\CreateSubscription;

class SubscriptionController extends Controller
{
    public function subscribe(CreateSubscription $request, User $user, Association $association)
    {
        dd($request);

        $request->validate($request->rules());

        $subscription = new Subscription;
        $subscription->association_id = $association->id;
        $subscription->user_id = $user->id;

        $subscription->save();

        return redirect()->back()->with('success', 'You subscribed to '.$association->name);
    }
}
