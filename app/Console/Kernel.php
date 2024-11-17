<?php

namespace App\Console;

use App\Console\Commands\AddProduct;
use App\Console\Commands\AddCategory;  // Import the AddCategory class
use App\Console\Commands\DeleteProduct;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AddProduct::class,  // Register the AddProduct command
        AddCategory::class, // Register the AddCategory command
        DeleteProduct::class, // Register the DeleteProducts command 
    ];

    protected function schedule(Schedule $schedule)
    {
        // Define the schedule for commands (if needed)
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
