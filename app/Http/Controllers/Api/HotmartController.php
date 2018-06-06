<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Carbon\Carbon;
use App\Models\Sale;

class HotmartController extends Controller
{
    public function access(Request $request)
    {
        $dataForm = $request->all();

        //Recupera os dados do curso a ser vendido
        $course = Course::where('code', $dataForm['prod'])->get()->first();

        //Recupera o usuario dono do curso
        $user = User::where('hottok', $dataForm['hottok'])->get()->first();

        //Verificando se a pessoa é dona do curso
        if ($course->user_id != $user->id)
            return response()->json(['error' => 'Not permission'], 401);
        //Recuperar o usuario pelo email
        $student = User::where('email', $dataForm['email'])->get()->first();
        //Se a pessoa tenta comprar o curso sem ser cadastrada
        //Então o estudante é cadastrado automaticamente
        if ($student == null) {
            $student = User::create([
                'name'          => $dataForm['name'],
                'email'         => $dataForm['email'],
                'url'           => createUrl($dataForm['name']).date('Hs'),//Função do Helper
                'password'      => bcrypt(generatePassword())//Função do Helper(Salvando a senha já criptografada)
            ]);
        }

        $date = Carbon::parse($dataForm['purchase_date'])->format('Y-m-d');

        //Venda
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