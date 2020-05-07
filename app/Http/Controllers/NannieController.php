<?php

namespace App\Http\Controllers;

use App\Http\Requests\NanniesRequest;
use App\Integrations\Nannyfy\NannifyClient;
use GuzzleHttp\Client;

class NannieController extends Controller
{
    public function getNannies(NanniesRequest $request){

        $nannifyClient = new NannifyClient(new Client());

        try{
            $nannies = $nannifyClient->getNannies($request);
        }catch(\Exception $e){
            return response()->json(['message' => __('There has been an error while integrating with Nannify')], 409);
        }
        return response()->json(json_decode($nannies), 200);
    }
}
