<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_parent_1', 'email_parent_2','child_id'
    ];
}
