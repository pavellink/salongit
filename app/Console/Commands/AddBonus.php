<?php

namespace App\Console\Commands;

use App\Models\Bonuses;
use App\Models\BonusLvl;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Services;
use App\Models\Statuses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddBonus extends Command
{
    protected $signature = 'add:bonus';
    protected $description = 'Поиск выполненных заказов, начисление бонуса, пометка для обновления bonus_lvl';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $orders = Orders::whereNull('bonus_received')->whereNotNull('user_id')->where('status', 4)
            ->get();

        foreach ($orders ?? [] as $order){
            $user = User::where('id', $order->user_id)->first();
            Orders::where('id', $order->id)->update(['bonus_received' => 1]);
            //$total = $order->total_services ? $order->total_services : $order->total;
            $status = Statuses::where('section', 'bonuses')->where('type', 1)->first();
            //$items = OrderItems::where('order_id', $order->id)->get();
            $lvl_id = $this->userLvl($user->id);
            $bonus_lvl = BonusLvl::where('id', $lvl_id)->first();
            $count_bonus = (($order->paid_amount - $order->total_items ?? 0) * ($bonus_lvl->percent / 100));


            Bonuses::firstOrCreate(
                [
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'status_id' => $status->id,
                ], [
                    'title' => $status->title,
                    'count' => $count_bonus,
                    'finish_at' => Carbon::parse($order->date)->addDays(45),
                    'created_at' => date('Y-m-d H:i:s')
                ]
            );

            User::where('id', $order->user_id)->update([
                'update_bonus' => 1,
                'update_lvl' => 1
            ]);
        }

        return true;
    }

    static function userLvl($user_id){
        $user = User::where('id', $user_id)->first();

        $lvl = $user->bonus_lvl_id;

        if(!$user->bonus_lvl_id){
            User::where('id', $user->id)->update([
                'bonus_lvl_id' => 1
            ]);

            $lvl = 1;
        }

        return $lvl;
    }
}
