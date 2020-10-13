<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'crm_customer';

    public function customers()
    {
        return $this->hasMany('App\Models\Customers','Suplant');
    }
}