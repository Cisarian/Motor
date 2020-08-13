<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'ability_id', 'role_id')->withTimestamps();
    }

}
