<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int child_id
 * @property string name
 * @property string description
 * @property int price
 * @property date date
 * @property int user_id
 */
class Expenditure extends Model
{
    public $timestamps = false;

    protected $table = 'Expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'child_id', 'name', 'description', 'price', 'date', 'user_id', 'task',
    ];

    function child()
    {
        return $this->belongsTo('App\Child');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }
}
