<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Publicacoes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;

class PublicacoesController extends Controller
{
    public function criarPublicacao(Request $request, $id){

        // retorno dos parametros para salvar a publicacao
        $id_usuario = $id;
        $textoPublicacao = $request->texto_publicacao;


        Publicacoes::create([
            'texto_publicacao' => $textoPublicacao,
            'user_id' => $id_usuario,
        ]);


        return redirect('dashboard/'.$id);

    }




}
