<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Participation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ParticipationController extends Controller
{
    public function participate(User $user, Activity $activity)
    {
        if (Auth::id() == $user->id) {
            $rule = [
                'activity_id' => [
                    'required',
                    Rule::unique('participations')->where(function ($query) use ($user, $activity) {
                        return $query->where('activity_id', $activity->id)
                        ->where('user_id', $user->id);
                    }),
                    'exists:activities,id',
                ],
                'user_id' => [
                    'required',
                ],
            ];

            $messages = [
                'activity_id.unique'  => 'You have already joined.',
                'activity_id.exists'  => 'Activity does not exist.',
            ];

            $validator = Validator::make([
                'activity_id'    => $activity->id,
                'user_id'        => $user->id,
            ], $rule, $messages);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            } else {
                $user->activities()->attach($activity->id);

                return redirect()->back()->with('success', 'You joined '.$activity->title);
            }
        } else {
            return redirect()->back()
                            ->withErrors('Joining failed');
        }
    }

    public function unparticipate(User $user, Activity $activity)
    {
        if (Auth::id() == $user->id) {
            $participation = Participation::where('activity_id', $activity->id)->where('user_id', $user->id)->first();

            if ($participation) {
                $user->activities()->detach($activity->id);

                return redirect()->back()->with('success', 'You unjoined '.$activity->title);
            } else {
                return redirect()->back()
                            ->withErrors('This user has not joined this activity.');
            }
        } else {
            return redirect()->back()
                            ->withErrors('Unjoined failed.');
        }
    }
}
