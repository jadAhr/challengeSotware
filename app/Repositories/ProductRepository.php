<?php 

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll(): Collection
    {
        return $this->product->all();
    }

    public function findById(int $id): ?Product
    {
        return $this->product->find($id);
    }

    public function create(array $data): Product
    {
        // Handle file upload (image)
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('images', 'public');
        }

        return $this->product->create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = $this->product->find($id);
        
        // Handle image update if present
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('images', 'public');
        }

        $product->update($data);
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = $this->product->find($id);
        return $product ? $product->delete() : false;
    }

    public function assignCategories(int $productId, array $categoryIds): Product
    {
        $product = $this->product->find($productId);
        $product->categories()->sync($categoryIds); // sync() attaches categories and removes old associations
        return $product;
    }

    public function detachCategories(int $productId, array $categoryIds): Product
    {
        $product = $this->product->find($productId);
        $product->categories()->detach($categoryIds); // detach() removes specific categories from product
        return $product;
    }
}

?>