<?php

namespace App\Widgets;

use App\Models\OrderPre;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Http\Request;
use Cookie;

class Aside extends AbstractWidget
{

    public function __construct(array $config = [], Request $request)
    {
        $this->page = $config['page'];
    }

    public function run()
    {
        $aside = Cookie::get('aside');
        $count_pre = OrderPre::where('status_id', '<=', 2)->count();

        return view('widgets.aside', [
            'aside' => $aside,
            'page' => $this->page,
            'count_pre' => $count_pre
        ]);
    }
}
