<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['country_id'];
    
    public function country()
        {
            return $this->belongsTo(Country::class);
        }
    
        public function address()
        {
            return $this->BelongsTo(Address::class);
        }
}
