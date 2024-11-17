<?php

// app/Console/Commands/AddProduct.php

namespace App\Console\Commands;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Console\Command;

class AddProduct extends Command
{
    protected $signature = 'product:add {name} {description} {price} {image}';
    protected $description = 'Add a new product to the database';

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
    }

    public function handle()
    {
        // Getting input arguments
        $name = $this->argument('name');
        $description = $this->argument('description');
        $price = $this->argument('price');
        $image = $this->argument('image'); // Assuming the image path or URL

        // Create the product
        $product = $this->productRepository->create([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image,  // You may want to handle image uploads more carefully
        ]);

        // Output a success message
        $this->info("Product '{$product->name}' created successfully!");
    }
    
}
