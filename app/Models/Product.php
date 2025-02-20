<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\ActiveProductsScope;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_sku',
        'product_image',
        'product_name',
        'product_description',
        'product_price',
        'product_veg_non_veg',
        'product_status',
        'category_id',
    ];


    protected static function booted()
    {
        static::addGlobalScope(new ActiveProductsScope);
    }

    // Mutator for category_name
    public function setProductNameAttribute($val)
    {
        $this->attributes['product_name'] = ucfirst($val);
    }

    // Relationship: Each product belongs to one category (subcategory)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
