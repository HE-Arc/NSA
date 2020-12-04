<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    public function subscribe(User $user, Association $association)
    {
        if (Auth::id() == $user->id) {
            $rule = [
                'association_id' => [
                    'required',
                    Rule::unique('subscriptions')->where(function ($query) use ($user, $association) {
                        return $query->where('association_id', $association->id)
                        ->where('user_id', $user->id);
                    }),
                    'exists:associations,id',
                ],
                'user_id' => [
                    'required',
                ],
            ];

            $messages = [
                'association_id.unique'  => 'You are already subscribed.',
                'associations_id.exists' => 'Association does not exist.',
            ];

            $validator = Validator::make([
                'association_id' => $association->id,
                'user_id'        => $user->id,
            ], $rule, $messages);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $user->subscriptions()->attach($association->id);

                return redirect()->back()->with('success', 'You subscribed to '.$association->name);
            }
        } else {
            return redirect()->back()
                            ->withErrors('Subscription failed');
        }
    }

    public function unsubscribe(User $user, Association $association)
    {
        if (Auth::id() == $user->id) {
            $subscription = Subscription::where('association_id',$association->id)->where('user_id',$user->id)->first();
            
            if($subscription){
                $user->subscriptions()->detach($association->id);
                return redirect()->back()->with('success', 'You unsubscribed to '.$association->name);
            }
            else
            {
                return redirect()->back()
                            ->withErrors('This subscription does not exist.');
            }
        }
        else
        {
            return redirect()->back()
                            ->withErrors('Unsubscription failed');
        }
    }
}
