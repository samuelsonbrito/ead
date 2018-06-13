<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreUpdateCategoryFormRequest;

class CategoryController extends Controller
{
    private $category, $totalPage = 8;

    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->middleware('auth:api')->except([
            'index',
        ]);
    }

    public function index(Request $request)
    {
        $category = $this->category->getResults($request->all(), $this->totalPage);

        return response()->json($category);
    }

    public function show($id)
    {
        $category = $this->category->find($id);
        if (!$category)            
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($category);
    }

    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 201);
    }

    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        $category = $this->category->find($id);

        if (!$category)            
            return response()->json(['error' => 'Not found'], 404);

        $category->update($request->all());
        
        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = $this->category->find($id);

        if (!$category)            
            return response()->json(['error' => 'Not found'], 404);

        $category->delete();

        return response()->json(['success' => 'true'], 204);
    }
}
