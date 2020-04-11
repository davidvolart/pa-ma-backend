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
                                                'partner_email' => 'bail|required|string|email|unique:users',
                                            ]);

        $family_code = uniqid('',true);
        $request->user()->family_code = $family_code;

        $child = new Child(['name' => $validatedData['child_name']]);
        $child->save();

        event(new FamilyRegisteredEvent($family_code, $validatedData['partner_email']));
    }
}
