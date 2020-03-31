<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildPersonalDataRequest;
use Illuminate\Support\Facades\Auth;

class ChildController
{
    public function storePersonalData(ChildPersonalDataRequest $request)
    {
        $id = Auth::id();
        return response()->json(['message' => 'saved' ], 200);
    }
}
