<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Http\Requests\StoreUpdateCourseFormRequest;

class CourseController extends Controller
{
    private $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function index(Request $request)
    {
        $course = $this->course->getResults();

        return response()->json($course);
    }

    public function show($id)
    {
        $course = $this->course->find($id);
        if(!$course)            
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($course);
    }

    public function store(StoreUpdateCourseFormRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $name = kebab_case($request->name);
            $extension = $request->image->extension();

            $fileName = "{$name}.{$extension}";
            $data['image'] = $fileName;

            $upload = $request->image->storeAs('courses', $fileName);

            if(!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $course = $this->course->create($data);

        return response()->json($course, 201);
    }

    public function update(StoreUpdateCourseFormRequest $request, $id)
    {
        $course = $this->course->find($id);

        if(!$course)            
            return response()->json(['error' => 'Not found'], 404);

        $course->update($request->all());
        
        return response()->json($course);
    }

    public function destroy($id)
    {
        $course = $this->course->find($id);

        if(!$course)            
            return response()->json(['error' => 'Not found'], 404);

        $course->delete();

        return response()->json(['success' => 'true'], 204);
    }
}
