<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    public function measurement()
    {
        return $this->belongsTo('App\Measurement');
    }
    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }
}
