<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Publicacoes;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboard($id)
    {
        // variaveis para fazer o retorno da pagina primaria
     
        $publicacoes = DB::select("SELECT * FROM publicacoes ORDER BY id desc");

        $allUsers= DB::select("SELECT * FROM users");

        $seguindo = DB::select("SELECT * FROM `seguidores` WHERE user_id =".$id);

        $comentarios = DB::select("SELECT * FROM comentarios c JOIN users u on u.id
            = c.user_id JOIN publicacoes p on p.id = c.id_postagem
        WHERE p.id like c.id_postagem");

        $todosUsuarios = DB::table('users')
            ->where('id', '<>', $id)
            ->get();


        $seguidores = DB::table('seguidores')
            ->get();


        if (!empty($publicacoes)){
            foreach ($publicacoes as $publicacao){

                    foreach ($allUsers as $user){
                        if($user->id == $publicacao->user_id)
                        $responsePublicacao[] =  array("id" => $publicacao->id, "user_id" => $publicacao->user_id, "texto_publicacao" => $publicacao->texto_publicacao, "name" => $user->name);
                    }
            }
        }
        

        $userLogado = DB::select("SELECT * FROM users where id = $id");

     

      
        $response = empty($responsePublicacao) ? $seguindo : $responsePublicacao;
       

        return view('dashboard.dashboard', ['userLogado' => $userLogado, 'publicacoes' => $response, 'todosUsuarios' => $todosUsuarios, 'seguidores' => $seguidores,
        'comentarios'=> $comentarios]);
    }


    public function dashboardsecundaria($id)
    {
        // variaveis para fazer o retorno da pagina primaria
            
        $publicacoes = DB::select("SELECT * FROM publicacoes ORDER BY id desc");

        $allUsers= DB::select("SELECT * FROM users");

        $seguindo = DB::select("SELECT * FROM `seguidores` WHERE user_id =".$id);

        $comentarios = DB::select("SELECT * FROM comentarios c JOIN users u on u.id
            = c.user_id JOIN publicacoes p on p.id = c.id_postagem
        WHERE p.id like c.id_postagem");

        $todosUsuarios = DB::table('users')
            ->where('id', '<>', $id)
            ->get();


        $seguidores = DB::table('seguidores')
            ->get();


        if (!empty($publicacoes)){
            foreach ($publicacoes as $publicacao){

                    foreach ($allUsers as $user){
                        if($user->id == $publicacao->user_id)
                        $responsePublicacao[] =  array("id" => $publicacao->id, "user_id" => $publicacao->user_id, "texto_publicacao" => $publicacao->texto_publicacao, "name" => $user->name);
                    }
            }
        }
        

        $userLogado = DB::select("SELECT * FROM users where id = $id");

        $response = empty($responsePublicacao) ? $seguindo : $responsePublicacao;
 
        return view('dashboard.dashboardsecundaria', ['userLogado' => $userLogado, 'publicacoes' => $response, 'todosUsuarios' => $todosUsuarios, 'seguidores' => $seguidores,
        'comentarios'=> $comentarios]);
    }

    function verificaSeguidor($user_id, $id){
        $result = DB::select("SELECT * FROM seguidores WHERE user_id = $id and user_seguindo = $user_id ");

        if (!empty($result)) return true;

    }

     function verificaSeguidorPublicacao($user_id, $id){

        if ($user_id == $id)  return true;

        else{
        $resultSeguidores = DB::select("SELECT * FROM seguidores WHERE user_id = $id and user_seguindo = $user_id ");
        }

        if (!empty($resultSeguidores)) return true;


    }

    function verificaSeguidorPublicacaoPostagem($user_id, $id){
        $result = DB::select("SELECT * FROM seguidores WHERE user_id = $id and user_seguindo = $user_id ");

        if (!empty($result)) return true;

    }
}
