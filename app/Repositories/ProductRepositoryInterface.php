<?php 



namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Product;
    public function create(array $data): Product;
    public function update(int $id, array $data): Product;
    public function delete(int $id): bool;

    // Methods for managing product-category relationships
    public function assignCategories(int $productId, array $categoryIds): Product;
    public function detachCategories(int $productId, array $categoryIds): Product;
}

 ?>
