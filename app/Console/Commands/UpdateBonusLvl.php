<?php

namespace App\Console\Commands;

use App\Models\BonusLvl;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateBonusLvl extends Command
{
    protected $signature = 'update:bonus_lvl';
    protected $description = 'Поиск заказов за промежуток времени, суммирование total и получение, изменение подходящего статуса клиента';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::whereNotNull('update_lvl')->whereNull('bonus_ban')->get();
        foreach ($users ?? [] as $user){
            $orders = Orders::where('user_id', $user->id)->where('status', 4)->get();
            $total = 0;
            foreach ($orders ?? [] as $order){
                $total = $total + ($order->total_services ? $order->total_services : $order->total);
            }
            $lvl = BonusLvl::orderBy('total', 'asc')->where('total', '>=', $total)->first();
            //dd($lvl);
            User::where('id', $user->id)->update([
                'update_lvl' => null,
                'bonus_lvl_id' => $lvl->id >= $user->bonus_lvl_id ? $lvl->id : $user->bonus_lvl_id,
                'count_orders' => count($orders)
            ]);
        }

        return true;
    }
}
