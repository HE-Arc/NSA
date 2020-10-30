<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Association;

class SubscriptionController extends Controller
{
    public function subscribe(User $user, Association $association)
    {
        error_log('ASSOCIATION ID'.$association->id);
        $subscription = new Subscription;
        $subscription->association_id = $association->id;
        $subscription->user_id = $user->id;

        $subscription->save();

        return redirect()->back()->with('success','You subscribed to '.$association->name);
    }
}
