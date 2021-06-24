<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class UsersController extends Controller
{


    public function login()
    {
        return view('authenticate.login');
    }

    public function verificaLogin(Request $request){

        //verifca se inputs estão validos

        $rules = [
            'name' => 'required',
            'password' => 'required'
        ];

        $messages = ['required'  => 'Preencha todos os campos!'];

        $this->validate($request, $rules, $messages);

        $name = $request->name;
        $password = $request->password;


        //requisição dos inputs no banco de dados
        $users = DB::table('users')
                ->where('name', '=', $name)
                ->where('password', '=', $password)
                ->get();


        //validação se o usúario existe ou não
        if($users->isEmpty()){

            return back()->with('error', 'Email ou senha inválidos!');
        }
        else{
            foreach ($users as $user){
                $id = $user->id;
            }
            return redirect('dashboard/'.$id);
        }

    }

    public function signup()
    {
        return view('authenticate.signup');
    }

    public function criarNovoUsuario(Request $request)
    {
        //verifca se inputs estão validos

            $rules = [
                'name' => 'required',
                'password' => 'min:6|required_with:password_confirm|same:password_confirm',
                'password_confirm' => 'min:6',
            ];

            $messages = [
                'same'  => 'Senhas não conferem',
                'required_with' => 'Senhas não conferem',
                'min' => 'Senha deve ter ao menos 6 carácteres',
            ];

            $this->validate($request, $rules, $messages);

            $name = $request->name;


            //validação para ver se nome já existe no banco de dados

            $users = DB::table('users')
                ->where('name', '=', $name)
                ->get();

            if(!$users->isEmpty()){
                return back()->with('error', 'Usúario já existe.');
            }

            else{
                User::create([
                    'name' => $request->name,
                    'password' => $request->password,
                    'password_confirm' => $request->password_confirm
                ]);

                return view('authenticate.login')->with('message','Cadastro realizado com sucesso você já pode logar .');
            }



    }



}
