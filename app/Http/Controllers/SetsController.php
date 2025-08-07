<?php


namespace App\Http\Controllers;


use App\Models\Items;
use App\Models\Services;
use App\Models\SetItems;
use App\Models\Sets;
use App\Models\SetServices;
use Illuminate\Http\Request;

class SetsController
{
    public function index(Request $request)
    {
        $items = Sets::with('service')->orderby('id', 'desc')->get();

        return view('sets.index',[
            'items' => $items,
        ]);
    }

    public function create()
    {
        $services = Services::whereNull('parent_id')->orderBy('position')->get();

        return view('sets.create',[
            'services' => $services,
        ]);
    }

    public function store(Request $request){
        $id = Sets::insertGetId([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('sets.edit', $id);
    }

    public function edit($id)
    {
        $item = Sets::where('id', $id)->first();
        $service = Services::
        with(['subs' => function ($q) use($item) {
            $q->with([
                'setItems' => function ($q) use ($item) {
                    $q->where('set_id', $item->id)->with('product');
                }
            ]);
            }])
        //with('subs.setItems.product')
            ->where('id', $item->service_id)->first();
        //$products = SetItems::where('service_id', $id)->orderBy('position')->get();

        $products = Items::get();
        foreach ($service->subs ?? [] as $sub){
            $total = 0;
            foreach ($sub->setItems ?? [] as $setItem){
                if($setItem->product){
                    $total = $total + ($setItem->product->price * $setItem->qty);
                }
            }
            $sub->total = $total;
        }

        //dd($service);

        return view('sets.edit',[
            'item' => $item,
            'service' => $service,
            'products' => $products
            //'services' => $services
        ]);
    }

    public function update($id, Request $request)
    {
        foreach ($request->sets ?? [] as $service_id => $array){
            $setService = SetServices::firstOrCreate(
                [
                    'set_id' => $id,
                    'service_id' => $service_id,
                ]
            );
            //dd($array);
            //$aa = array_combine();
            //$items = array_combine($array['id'], $aa);
            //dd($aa);
            foreach ($array ?? [] as $setItem_id => $setItem){

                //dd($setItem_id);
                $product = Items::where('id', $setItem['product_id'])->first();

                SetItems::where('id', $setItem_id)->where('set_id', $id)->where('service_id', $service_id)->update([
                    'set_service_id' => $setService->id,
                    'item_id' => $product ? $setItem['product_id'] : null,
                    'qty' => $setItem['qty'],
                    'total' => $product && $setItem['qty'] && $product->price ? ($product->price * $setItem['qty']) : null
                ]);

            }
            //dd($result);
        }

        //dd($request->all());

        return redirect()->back();
    }
}
