<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'id_card', 'health_care_number', 'birthdate', 'shirt_size', 'pants_size', 'dress_size', 'shoes_size', 'height', 'weight'
    ];

    function vaccine() {
        return $this->hasMany('App\Vaccine');
    }
}
