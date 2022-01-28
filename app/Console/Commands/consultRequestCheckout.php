<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use \App\Http\Controllers\WebCheckoutController;

class consultRequestCheckout extends Command
{
    protected $signature = 'consult:checkout {reference?}';
    protected $description = 'consult response for PlacetoPay request';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->line('Start to consult pending request');

        WebCheckoutController::jobConsultRequest();

        $this->info('The command finish');
    }
}
