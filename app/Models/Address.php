<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function city()
    {
        return $this->hasOne(City::class);
    }
}
