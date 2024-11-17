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
    public function deleteMultiple(array $ids): bool;
   
}

 ?>
