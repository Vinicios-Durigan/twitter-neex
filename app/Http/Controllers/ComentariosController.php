<?php

namespace App\Http\Controllers;
use App\Models\Comentarios;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Publicacoes;
use Illuminate\Support\Facades\DB;

class ComentariosController extends Controller
{
    public function criarComentario(Request $request, $id){

        //Retorno dos parametros para fazer a insercao no banco
        Comentarios::create([
            'id_postagem' => $request->input('id_postagem'),
            'user_id' => $id,
            'comentario' => $request->input('comentario')
        ]);


        return redirect('dashboard/'.$id);
    
    }

    public function criarComentarioSecundario(Request $request, $id){

        //Retorno dos parametros para fazer a insercao no banco
        Comentarios::create([
            'id_postagem' => $request->input('id_postagem'),
            'user_id' => $id,
            'comentario' => $request->input('comentario')
        ]);


        return redirect('dashboardsecundaria/'.$id);
    
    }
}
