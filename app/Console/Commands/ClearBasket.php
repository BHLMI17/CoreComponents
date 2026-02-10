<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearBasket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-basket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    \App\Models\Basket::truncate();
    $this->info('Basket table cleared successfully.');
}
}
