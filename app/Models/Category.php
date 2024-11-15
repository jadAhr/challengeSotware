<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = ['name', 'parent_category_id'];

    // Define the relationship between categories
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    // Define the relationship between categories and products
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
