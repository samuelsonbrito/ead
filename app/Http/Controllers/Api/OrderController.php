<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Http\Requests\StoreUpdateOrderFormRequest;

class OrderController extends Controller
{
    private $order;

    public function __construct(Order $course)
    {
        $this->order = $order;
    }

    public function index(Request $request)
    {
        $order = $this->order->getResults();

        return response()->json($order);
    }

    public function show($id)
    {
        $order = $this->order->find($id);
        if(!$order)            
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($order);
    }

    public function store(StoreUpdateOrderFormRequest $request)
    {
        $order = $this->order->create($request->all());

        return response()->json($order, 201);
    }

    public function update(StoreUpdateOrderFormRequest $request, $id)
    {
        $order = $this->order->find($id);

        if(!$order)            
            return response()->json(['error' => 'Not found'], 404);

        $order->update($request->all());
        
        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = $this->order->find($id);

        if(!$order)            
            return response()->json(['error' => 'Not found'], 404);

        $order->delete();

        return response()->json(['success' => 'true'], 204);
    }
}
