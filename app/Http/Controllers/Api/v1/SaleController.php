<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Http\Requests\StoreUpdateSaleFormRequest;

class SaleController extends Controller
{
    private $sale;

    public function __construct(Sale $course)
    {
        $this->sale = $sale;
    }

    public function index(Request $request)
    {
        $sale = $this->sale->getResults();

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
        $sale = $this->sale->create($request->all());

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
}
