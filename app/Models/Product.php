<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the table if it's different from the plural form of the model name
    protected $table = 'products';

    // The attributes that are mass assignable
    protected $fillable = ['name','description','price','image',
    ];

    // The attributes that should be hidden for arrays
    protected $hidden = [];

    // The attributes that should be cast to native types
    protected $casts = [
        'price' => 'float', // Ensures price is cast to a float
    ];

    /**
     * Relationship: A product belongs to many categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
        
}
}
