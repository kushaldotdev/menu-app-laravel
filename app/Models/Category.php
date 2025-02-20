<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\ActiveCategoriesScope;


class Category extends Model
{
    use HasFactory;


    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'category_description',
        'category_logo',
        'category_status',
        'parent_category_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveCategoriesScope);
    }

    // Mutator for category_name
    public function setCategoryNameAttribute($val)
    {
        $this->attributes['category_name'] = ucfirst($val);
    }

    // **Mutator to Enforce Main Category Rule**
    public function setParentCategoryIdAttribute($value)
    {
        // If parent_category_id is 0 or NULL, force it to NULL (treat as main category)
        $this->attributes['parent_category_id'] = $value == 0 ? null : $value;
    }


    // Relationship: A category can have multiple subcategories (children)
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'category_id');
    }

    // Relationship: A category can belong to a parent category
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'category_id');
    }


    // Relationship: A category can have multiple products.
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
