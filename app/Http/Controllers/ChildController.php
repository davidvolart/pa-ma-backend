<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildPersonalDataRequest;
use App\Http\Resources\ChildUserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController
{
    public function storePersonalData(ChildPersonalDataRequest $request)
    {
        $id = Auth::id();
        return response()->json(['message' => 'saved' ], 200);
    }

    public function listChilds(Request $request)
    {
        dd('hoooo');
        $children = $request->user()->children_id;
        dd($children);

        //return new ChildUserCollection($children);
    }
}
