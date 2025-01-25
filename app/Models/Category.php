<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
