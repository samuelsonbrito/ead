<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Http\Requests\StoreUpdateSaleFormRequest;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    private $sale, $totalPage = 8;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;

        $this->middleware('auth:api')->except([
            'index',
            'show',
            //'myCourse'
        ]);
    }

    public function index(Request $request)
    {
        $sale = $this->sale->getResults($request->all(), $this->totalPage);

        return response()->json($sale);
    }

    public function show($id)
    {
        $sale = $this->sale->find($id);

        if (!$sale)            
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($sale);
    }

    public function store(StoreUpdateSaleFormRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $sale = $this->sale->create($data);

        return response()->json($sale, 201);
    }

    public function update(StoreUpdateSaleFormRequest $request, $id)
    {
        $sale = $this->sale->find($id);

        if (!$sale)            
            return response()->json(['error' => 'Not found'], 404);

        $sale->update($request->all());
        
        return response()->json($sale);
    }

    public function destroy($id)
    {
        $sale = $this->sale->find($id);

        if (!$sale)            
            return response()->json(['error' => 'Not found'], 404);

        $sale->delete();

        return response()->json(['success' => 'true'], 204);
    }

    public function mySales(Request $request)
    {
        $data['user_id'] = Auth::id();

        $sale = $this->sale->getResults($data, $this->totalPage);

        return response()->json($sale);
    }
}
