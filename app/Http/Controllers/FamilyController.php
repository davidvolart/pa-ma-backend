<?php

namespace App\Http\Controllers;

use App\Child;
use App\Events\FamilyRegisteredEvent;
use App\Http\Requests\FamilyRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function registerFamily(FamilyRequest $request)
    {
        $user = Auth::user();
        $partner_email = $request->email;
        $family_code = uniqid('', true);

        $user->family_code = $family_code;
        $user->partner_email = $partner_email;
        $user->save();

        $child = new Child(['name' => $request->child_name]);
        $child->save();

        $request->user()->children_id = $child->id;

        event(new FamilyRegisteredEvent($family_code, $partner_email));

        return response()->json(['message' => 'Family successfully registered.'], 200);
    }

    public function listColorUsers(Request $request)
    {
        $user_id = $request->user()->id;
        $user1 = User::find($user_id);
        $user2 = User::where('email', $user1->partner_email)->first();

        return [['name' => $user1->name, 'color' => $user1->color],
                ['name' => $user2->name, 'color' => $user2->color]
        ];
    }
}
