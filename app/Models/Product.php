<?php

namespace App\Models;

use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product_detail()
    {
        return $this->hasOne(ProductDetail::class);
    }
}
