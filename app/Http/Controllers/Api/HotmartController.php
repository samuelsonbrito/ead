<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Course, Sale};
use Carbon\Carbon;

class HotmartController extends Controller
{
    public function access(Request $request)
    {
        $dataForm = $request->all();

        $course = Course::where('code', $dataForm['prod'])->get()->first();

        $user = User::where('hottok', $dataForm['hottok'])->get()->first();

        if ($course->user_id != $user->id)
            return response()->json(['error' => 'Not permission'], 401);

        $student = User::where('email', $dataForm['email'])->get()->first();

        if ($student == null) {
            $student = User::create([
                'name'          => $dataForm['name'],
                'email'         => $dataForm['email'],
                'url'           => createUrl($dataForm['name']).date('Hs'),
                'password'      => bcrypt(generatePassword())
            ]);
        }

        $date = Carbon::parse($dataForm['purchase_date'])->format('Y-m-d');

        $newSale = Sale::create([
            'course_id' => $course->id,
            'user_id' => $student->id,
            'transaction' => $dataForm['transaction'],
            'status' => $dataForm['status'],
            'date' => $date,
        ]);

        if ($newSale)
            return response()->json(['success' => 'Success'], 200);
        else
            return response()->json(['error' => 'Fail'], 500);
    }
}