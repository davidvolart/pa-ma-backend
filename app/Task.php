<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;

    protected $table = 'Tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'child_id', 'name', 'description', 'date', 'user_id', 'color',
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
