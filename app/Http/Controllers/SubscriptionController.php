<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Association;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\CreateSubscription;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    public function subscribe(User $user, Association $association)
    {
        $rule = [
            'association_id' => [
                'required',
                Rule::unique('subscriptions')->where(function ($query) use($user,$association) {
                    return $query->where('association_id', $association->id)
                    ->where('user_id', $user->id);
                }),
            ],
        ];

        $validator = Validator::make([
            'association_id' => $association->id,
            'user_id' => $user->id
        ],$rule);


        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $subscription = new Subscription;
            $subscription->association_id = $association->id;
            $subscription->user_id = $user->id;

            $subscription->save();

            return redirect()->back()->with('success', 'You subscribed to '.$association->name);
        }
    }
}
