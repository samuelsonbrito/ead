<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Requests\StoreUpdateCourseFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    private $course, $totalPage = 8;
    private $path = 'courses';

    public function __construct(Course $course)
    {
        $this->course = $course;
        
        $this->middleware('auth:api')->except([
            'index',
            'show',
            //'myCourse'
        ]);
        
        //$this->middleware('check.permission:admin')->except([
            //'index',
            //'show',
            //'myCourse'
        //]);
    }

    public function index(Request $request)
    {
        $course = $this->course->getResults($request->all(), $this->totalPage);

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
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $name = kebab_case($request->name);
            $extension = $request->image->extension();

            $fileName = "{$name}.{$extension}";
            $data['image'] = $fileName;

            $upload = $request->image->storeAs($this->path, $fileName);

            if (!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);
        }

        $data['user_id'] = Auth::id();
        $data['url'] = str_slug($request->name,'-');

        $course = $this->course->create($data);

        return response()->json($course, 201);
    }

    public function update(StoreUpdateCourseFormRequest $request, $id)
    {
        $course = $this->course->find($id);

        if(!$course)            
            return response()->json(['error' => 'Not found'], 404);

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            if ($course->image) {
                if(Storage::exists("{$this->path}/{$course->image}"))
                    Storage::delete("{$this->path}/{$course->image}");
            }
    
            $name = kebab_case($request->name);
            $extension = $request->image->extension();
    
            $fileName = "{$name}.{$extension}";
            $data['image'] = $fileName;
    
            $upload = $request->image->storeAs($this->path, $fileName);
    
            if(!$upload)
                return response()->json(['error' => 'Fail_Upload'], 500);

        }

        //$data['url'] = str_slug($request->name,'-');

        $course->update($data);
        
        return response()->json($course);
    }

    public function destroy($id)
    {
        $course = $this->course->find($id);

        if (!$course)            
            return response()->json(['error' => 'Not found'], 404);

        if ($course->delete())
            if ($course->image) {
                if (Storage::exists("{$this->path}/{$course->image}"))
                    Storage::delete("{$this->path}/{$course->image}");
            }

        return response()->json(['success' => 'true'], 204);
    }

    public function myCourse($url)
    {
        $data['user_id'] = Auth::id();
        $data['url'] = $url;

        $course = $this->course->getMyCourse($data);

        if(!$course)            
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($course, 201);

    }
}
