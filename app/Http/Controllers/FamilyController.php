<?php

namespace App\Http\Controllers;

use App\Child;
use App\Events\FamilyRegisteredEvent;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function registerFamily(Request $request)
    {
        $validatedData = $request->validate([
                                                'child_name' => 'bail|required|string',
                                                'email' => 'bail|required|string|email|unique:users',
                                            ]);

        $partner_email = $validatedData['email'];
        $family_code = uniqid('',true);

        $request->user()->family_code = $family_code;
        $request->user()->partner_email = $partner_email;
        $request->user()->save();

        $child = new Child(['name' => $validatedData['child_name']]);
        $child->save();

        event(new FamilyRegisteredEvent($family_code, $partner_email));
    }
}
