<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname1','surname2','id_card','height','weight'
    ];
}
