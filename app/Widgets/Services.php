<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Services extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    public function run()
    {
        $services = \App\Models\Services::with('subs')->whereNull('parent_id')->where('published', 1)->get();

        foreach ($services ?? [] as $service){
            $min = null;
            $max = null;
            $minTime = null;
            $maxTime = null;
            foreach ($service->subs ?? [] as $sub){
                if (is_null($min) || $sub->price < $min) {
                    //$minIndex = $k;
                    $min = $sub->price;
                }
                if (is_null($max) || $sub->price > $max) {
                    //$minIndex = $k;
                    $max = $sub->price;
                }

                if (is_null($minTime) || $sub->mins < $minTime) {
                    //$minIndex = $k;
                    $minTime = $sub->mins;
                }

                if (is_null($maxTime) || $sub->mins > $maxTime) {
                    //$minIndex = $k;
                    $maxTime = $sub->mins;
                }
            }
            $service->min_price = $min;
            $service->max_price = $max;
            $service->min_time = $minTime;
            $service->max_time = $maxTime;
        }

        return view('widgets.services', [
            'config' => $this->config,
            'services' => $services
        ]);
    }
}
