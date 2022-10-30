<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Subcategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];

    // category has many sub category
    public function subcategory()
    {
         return $this->hasMany(Subcategories::class, 'category_id', 'id');
    }
    //relationships between category and product
    public function product()
    {
     return $this->hasManyThrough(Product::class, Subcategories::class,'category_id','subcategory_id', 'id','id');
    }


}
