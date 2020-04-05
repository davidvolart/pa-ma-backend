<?php

namespace App;

use App\Models\Affiliate;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int child_id
 * @property string name
 * @property date date
 */
class Vaccine extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'child_id', 'date'
    ];

    function child()
    {
        return $this->belongsTo('App\Child');
    }
}
