<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Http\Requests\StoreUpdateModuleFormRequest;

class ModuleController extends Controller
{
    private $module, $totalPage = 8;

    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    public function index(Request $request)
    {
        $module = $this->module->getResults($request->all(), $this->totalPage);

        return response()->json($module);
    }

    public function show($id)
    {
        $module = $this->module->find($id);
        if (!$module)            
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($module);
    }

    public function store(StoreUpdateModuleFormRequest $request)
    {
        $module = $this->module->create($request->all());

        return response()->json($module, 201);
    }

    public function update(StoreUpdateModuleFormRequest $request, $id)
    {
        $module = $this->module->find($id);

        if (!$module)            
            return response()->json(['error' => 'Not found'], 404);

        $module->update($request->all());
        
        return response()->json($module);
    }

    public function destroy($id)
    {
        $module = $this->module->find($id);

        if (!$module)            
            return response()->json(['error' => 'Not found'], 404);

        $module->delete();

        return response()->json(['success' => 'true'], 204);
    }
}
