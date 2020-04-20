<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    public function measurement()
    {
        return $this->hasOne('App\Measurement');
    }
}
