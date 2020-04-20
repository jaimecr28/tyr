<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public function type_sensor(){

        return $this->belongsTo('App\Type_sensor');
        
    }
    public function sector(){

        return $this->belongsTo('App\Sector');

    }
    public function enterprise(){

        return $this->belongsTo('App\Enterprise');

    }
    public function measurements(){

        return $this->hasMany('App\Measurement');

    }
}
