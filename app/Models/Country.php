<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['id'];

    public function address()
        {
            return $this->belongsTo(Address::class);
        }

    public function cities()
        {
            return $this->hasMany(City::class);
        }
}