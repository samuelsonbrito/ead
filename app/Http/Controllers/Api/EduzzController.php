<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Course, Sale};
use Carbon\Carbon;

class EduzzController extends Controller
{
    public function access(Request $request)
    {
        $dataForm = $request->all();

        if($dataForm['api_key'] == 'SUACHAVEDEAPI' )
        {
            switch ($dataForm['trans_status'])
            {
                case '3' :
                    #Pagou
                    $this->liberaAcesso();
                    break;
                case '6':   #Aguardando reembolso
                case '7':   #Reembolsado
                    $this->removeAcesso();
                    break;
                default:
                    echo "STATUS DESCONHECIDO";
                    break;
            }
        }else{
            echo "ACESSO INVALIDO";
        }
    }


		
	private function liberaAcesso()
	{
		echo "ACESSO LIBERADO";
	}
	private function removeAcesso()
	{
		echo "ACESSO REMOVIDO";
	}
}