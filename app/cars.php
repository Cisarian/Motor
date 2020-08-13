<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class cars extends Model
{
    //
    use Notifiable;

    protected $guarded = [];

    public function image()
    {
        return $this->morphMany(images::class, 'imageable');
    }
}
