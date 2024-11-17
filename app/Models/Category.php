<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the correct table name
    protected $table = 'categories';  // Ensure this matches the table name in your database

    // The attributes that are mass assignable
    protected $fillable = ['name', 'parent_id'];

    // Define the relationship between categories
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
}