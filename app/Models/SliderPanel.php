<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderPanel extends Model
{
    use HasFactory;
    protected $guard = [];
    protected $fillable = ['name','title','image_url','description','isSlide'];
}