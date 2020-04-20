<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_sensor extends Model
{
    public function sensors(){
        
        return $this->hasMany('App\Sensor');
    }
}
