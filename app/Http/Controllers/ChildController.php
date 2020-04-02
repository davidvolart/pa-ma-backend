<?php

namespace App\Http\Controllers;

use App\Child;
use App\Http\Requests\ChildPersonalDataRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController
{
    /**
     * @param ChildPersonalDataRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePersonalData(ChildPersonalDataRequest $request)
    {
        $child_id = Auth::user()->child_id;
        if ($child_id != null) {
            $child = Child::find($child_id);

            $personal_data_keys = ['name','id_card','health_care_number','birthdate'];

            foreach ($personal_data_keys as $key){
                $value = request($key);
                if($key == 'birthdate'){
                    $date = explode('/',$value);
                    $value = Carbon::createFromDate($date[2], $date[1], $date[0], 'Europe/Madrid');
                }
                $child->$key = $value;
            }
            $child->save();
            return response()->json(['message' => 'Child personal data has been updated.'], 200);
        }
        return response()->json(['message' => 'User has not registered a child yest.'], 400);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listChild(Request $request)
    {
        $child_id = $request->user()->child_id;
        if ($child_id == null) {
            return response()->json(['message' => 'User has not registered a child yest.', "child" => null], 200);
        }
        $child = Child::find($child_id);
        return response()->json(['message' => 'User has a child registered.', "child" => $child], 200);
    }
}
