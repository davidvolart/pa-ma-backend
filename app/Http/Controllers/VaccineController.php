<?php

namespace App\Http\Controllers;

use App\Child;
use App\Http\Requests\VaccineRequest;
use App\Vaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccineController
{
    public function listVaccines(Request $request)
    {
        $child_id = $request->user()->child_id;
        if ($child_id == null) {
            return response()->json(['message' => 'User has not registered a child yest.', "child" => null], 400);
        }
        $child = Child::find($child_id);
        return response()->json(['message' => 'List of vaccines taken for child.', "vaccines" => $child->vaccines()->get()], 200);
    }

    public function storeVaccine(VaccineRequest $request)
    {
        $child_id = Auth::user()->child_id;
        if ($child_id == null) {
            return response()->json(['message' => 'User has not registered a child yest.', "child" => null], 400);
        }

        $vaccine = new Vaccine;
        $vaccine->name = request("name");
        $vaccine->child_id = $child_id;

        if($date_value = $this->getDateInUniversalFormat()){
            $vaccine->date = $date_value;
            $vaccine->save();
            return response()->json(['message' => 'Vaccine stored correctly', "vaccine" => Vaccine::find($vaccine->id)], 201);
        }

        return response()->json(['message' => 'Field birthdate must be a correct date format.'], 400);
    }

    private function getDateInUniversalFormat(){
        try {
            $date = explode('/', request("date"));
            $date_value = Carbon::createFromDate($date[2], $date[1], $date[0], 'Europe/Madrid');
            return $date_value;
        } catch (\Exception $e) {
            return null;
        }
    }
}
