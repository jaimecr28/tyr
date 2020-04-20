<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public function sensors()
    {
        return $this->hasMany('App\Sensor');
    }
}
