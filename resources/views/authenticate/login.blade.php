<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo asset('css/authenticate/style.css')?>" >
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <section class="container">
        <div id="col-1">
          <img src="../assets/logo-neex-brasil.png.webp" alt="Neex Brasil">
        </div>
        <div id="col-2">

            <form action="{{route('verifica_login')}}" method="POST">
            @csrf
                @if(!empty($message))
                    <div class="cadastro-sucesso"> {{ $message }}</div>
                @endif
                <h1>Twitter Neex</h1>
                <p>Entrar no twitter</p>

                <div class="container-form">

                  <label for="uname"><b>Usúario</b></label>
                  <input type="text" placeholder="Digite o nome do usúario" name="name" required>

                  <label for="psw"><b>Senha</b></label>
                  <input type="password" placeholder="Digite a senha" name="password" required>

                  <label for="">

                      @error('name')
                      <span style="color:red; font: size 16px; margin-bottom: 5px;">{{$message}}</span>
                      @enderror
                      @if(session()->has('error'))
                      <span style="color:red; font: size 16px; margin-bottom: 5px;">{{ session()->get('error') }}</span>
                      @endif
                  </label>
                  <div class="buttons">
                    <button type="submit">Entrar</button>
                    <a href="{{ url('signup') }}">Inscrever-se</a>
                  </div>
                </div>

              </form>
        </div>
        </div>
    </section>
</body>
</html>
