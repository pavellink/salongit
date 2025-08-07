<?php

namespace App\Console\Commands;

use App\Models\Orders;
use App\Models\Shifts;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateCountShiftOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:count:shift:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The console command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Log::info('Проверка рейтинга 1');
        $checks = Shifts::whereNotNull('update_orders')->get();
        foreach ($checks ?? [] as $check){
            $count = Orders::where('shift_id', $check->id)->whereNull('in_progress')->whereNotNull('status')->count();

            Shifts::where('id', $check->id)->update([
                'update_orders' => null,
                'count_orders' => $count
            ]);

        }

        return true;
    }
}
