<?php


namespace App\Console\Commands;


use App\Models\Bonuses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateBonus extends Command
{
    protected $signature = 'update:bonus';
    protected $description = 'Получение списка бонусов, суммирование, обновление в user -> count_bonuses';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $from = Carbon::now()->subMonths(12);
        $to = Carbon::now();

        $users = User::whereNotNull('update_bonus')->whereNull('bonus_ban')
            //->where('id', 18)
            ->get();

        foreach ($users ?? [] as $user){
            $bonuses = Bonuses::where('user_id', $user->id)->whereBetween('created_at', [$from, $to])->get();
            $total = 0;
            foreach ($bonuses ?? [] as $bonus){
                if($bonus->status_id == 1){
                    $total = $total + $bonus->count;
                } elseif ($bonus->status_id == 2){
                    $total = $total - $bonus->count;
                    if($total < 0){
                        $total = 0;
                    }
                }
            }
            //dd($total);
            User::where('id', $user->id)->update([
                'count_bonuses' => $total,
                'update_bonus' => null
            ]);
        }

        return true;
    }

}
