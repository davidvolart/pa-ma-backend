<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'child_id', 'name','date'
    ];

    function child() {
        return $this->belongsTo('App\Child');
    }
}
