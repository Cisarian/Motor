<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    //

    protected $guarded = [];

    public function imageable()
    {
        return $this->morphTo();
    }
}
