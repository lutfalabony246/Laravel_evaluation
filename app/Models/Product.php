<?php

namespace App\Models;

use App\Models\Categories;
use App\Models\Subcategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'subcategory_id',
        'price',
        'thumbnail',
    ];
    // product belongs to subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategories::class, 'subcategory_id', 'id');
    }
     //relationships between category and product
     public function category()
     {
      return $this->hasOneThrough(Categories::class, Subcategories::class,'id','id','subcategory_id','category_id');
     }
}
