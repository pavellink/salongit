<?php


namespace App\Http\Controllers;


use App\Filters\LogFilter;
use App\Models\Log;
use App\Models\LogActs;
use App\Models\User;
use Illuminate\Http\Request;

class LogController
{
    public function index(Request $request)
    {
        $items = Log::with('user')->orderBy('id', 'desc');
        $items = (new LogFilter($items, $request))->apply()->paginate(25);

        $users = User::whereNotNull('role')->get();

        $acts = LogActs::get();

        return view('log.index', [
            'items' => $items,
            'users' => $users,
            'acts' => $acts
        ]);
    }

    public function items(Request $request)
    {
        $items = Log::with('user')->orderBy('id', 'desc');
        $items = (new LogFilter($items, $request))->apply()->paginate(25);

        return view('log.items',[
            'items' => $items
        ]);
    }
}
