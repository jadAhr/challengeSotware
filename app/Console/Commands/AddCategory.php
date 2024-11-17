<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;  // Make sure to import the correct Category model

class AddCategory extends Command
{
    // The name and signature of the console command.
    protected $signature = 'categories:add {name*} {--parent_id= : The ID of the parent category}';

    // The console command description.
    protected $description = 'Create new categories and optionally set a parent category.';

    public function __construct()
    {
        parent::__construct();
    }

    // Execute the console command.
    public function handle()
    {
        $categoryNames = $this->argument('name');
        $parentId = $this->option('parent_id');

        // Validate that the parent category exists if provided
        if ($parentId && !Category::find($parentId)) {
            $this->error("Parent category with ID {$parentId} does not exist.");
            return;
        }

        foreach ($categoryNames as $categoryName) {
            // Create the category
            $category = Category::create([  // Use capital 'Category' here
                'name' => $categoryName,
                'id_parent' => $parentId,  // Ensure to use 'id_parent' here
            ]);

            $this->info("Category '{$categoryName}' created successfully.");
        }
    }
}
