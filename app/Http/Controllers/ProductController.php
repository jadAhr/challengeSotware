<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->productRepository->findById($id);
        return view('products.show', compact('product'));
    }

    public function store(Request $request)
    {
        $product = $this->productRepository->create($request->all());
        return redirect()->route('products.index');
    }

    public function update($id, Request $request)
    {
        $product = $this->productRepository->update($id, $request->all());
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect()->route('products.index');
    }
}
