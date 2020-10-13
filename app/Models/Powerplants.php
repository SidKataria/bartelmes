<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Powerplants extends Model
{
    protected $table = 'crm_powerplants';

    public function subpowerplants()
    {
        return $this->hasMany('App\Models\Powerplants','SubplantID');
    }
}