<?php

namespace App\Integrations\Nannyfy;

use App\Http\Requests\NanniesRequest;

class NannifyInputObject
{
    public $day;
    public $start;
    public $end;
    public $postal;
    public $lat;
    public $long;
    public $languages;
    public $skills;
    public $can_kid;
    public $can_teen;
    public $can_baby;
    public $distance;

    public function __construct(NanniesRequest $request)
    {
        $this->day = $request->day;
        $this->start = str_replace(':','',$request->start);
        $this->end = str_replace(':','',$request->end);
        $this->postal = "";
        $this->lat = $request->lat;
        $this->long = $request->long;
        $this->languages = "";
        $this->skills = "";
        $this->can_kid = 1;
        $this->can_teen=1;
        $this->can_baby=1;
        $this->distance = 20;
    }
}
