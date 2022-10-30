<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category_id',
    ];
     // subcategory has many products
     public function product()
     {
          return $this->hasMany(Product::class, 'subcategory_id', 'id');
     }
         // subcategory belongs to category
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
