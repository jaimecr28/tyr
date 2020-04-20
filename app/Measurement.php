<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }
    public function warning()
    {
        return $this->belongsTo('App\Warning');
    }
}
