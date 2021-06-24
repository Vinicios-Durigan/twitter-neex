<?php

namespace App\Http\Controllers;

use App\Models\Seguidores;
use App\Models\Publicacoes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SeguidoresController extends Controller
{
    public function seguirUsuario(Request $request, $id){


        $id_usuario = $id;
        $userSeguindo = $request->input('user_seguindo');


        // verificacao para ver se o seguidor ja esta seguindo no banco
        $verificarSeguidores = DB::select("SELECT * FROM `seguidores` WHERE user_id =".$id . " AND user_seguindo = $userSeguindo"  );


        $dashboard_controller = new DashboardController;

        if($verificarSeguidores){
            DB::delete("delete FROM `seguidores` WHERE user_id =".$id . " AND user_seguindo = $userSeguindo"  );
             return redirect('dashboard/'.$id);
        }
        else{
        // insercao de seguidor no banco se ainda nao existe
            Seguidores::create([
                'user_id' => $id_usuario,
                'user_seguindo' => $userSeguindo
        ]);

        // instancia da classe dashboard para retornar os dados na tela principal
       
        return redirect('dashboard/'.$id);
        }
    }
}
