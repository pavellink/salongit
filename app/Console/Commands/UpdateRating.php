<?php

namespace App\Console\Commands;

use App\Models\ItemReviews;
use App\Models\Items;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:rating';

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
        Log::info('Проверка рейтинга');
        $goods = Items::whereNotNull('update_rating')->get();

        foreach ($goods ?? [] as $item){
            Log::info('Проверка рейтинга 1');
            $reviews = ItemReviews::where('item_id', $item->id)->where('published', 1)->get();

            $count = $reviews->count();

            $sum = 0;
            foreach ($reviews as $review){
                $sum = $sum + $review->rating;
            }

            $rating = $sum / $count;

            Items::where('id', $item->id)->update([
                'rating' => round($rating, 1),
                'update_rating' => null,
                'count_reviews' => $count
            ]);

        }
        Log::info('Проверка рейтинга 2');
        return true;
    }
}
