<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Requests\StoreUpdateClassroomFormRequest;

class ClassroomController extends Controller
{
    private $classroom, $totalPage = 8;
    

    public function __construct(Classroom $classroom)
    {
        $this->classroom = $classroom;
        $this->middleware('auth:api')->except([
            
        ]);
    }

    public function index(Request $request)
    {
        $classroom = $this->classroom->getResults($request->all(), $this->totalPage);

        return response()->json($classroom);
    }

    public function show($id)
    {
        $classroom = $this->classroom->find($id);
        if (!$classroom)            
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($classroom);
    }

    public function store(StoreUpdateClassroomFormRequest $request)
    {
        $classroom = $this->classroom->create($request->all());

        return response()->json($classroom, 201);
    }

    public function update(StoreUpdateClassroomFormRequest $request, $id)
    {
        $classroom = $this->classroom->find($id);

        if (!$classroom)            
            return response()->json(['error' => 'Not found'], 404);

        $classroom->update($request->all());
        
        return response()->json($classroom);
    }

    public function destroy($id)
    {
        $classroom = $this->classroom->find($id);

        if (!$classroom)            
            return response()->json(['error' => 'Not found'], 404);

        $classroom->delete();

        return response()->json(['success' => 'true'], 204);
    }
}
