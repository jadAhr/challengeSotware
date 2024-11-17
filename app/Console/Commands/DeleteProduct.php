<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ProductRepositoryInterface;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:remove {ids*}'; // Accepts one or more ids

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete one or more products by their IDs';

    protected $productRepository;

    // Constructor to inject the repository dependency
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
    }

    public function handle()
    {
        // Get the 'ids' argument from the command
        $ids = $this->argument('ids'); // This will be an array, even if it has only one element

        if (count($ids) === 1) {
            // Handle the case when only one ID is provided
            $deleted = $this->productRepository->delete($ids[0]);
            $message = "Product with ID {$ids[0]} has been deleted.";
        } else {
            // Handle the case when multiple IDs are provided
            $deleted = $this->productRepository->deleteMultiple($ids);
            $message = "Products with IDs " . implode(", ", $ids) . " have been deleted.";
        }

        if ($deleted) {
            $this->info($message);
        } else {
            $this->error("No products found with the provided IDs.");
        }
    }
}


