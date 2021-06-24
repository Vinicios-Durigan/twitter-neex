<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComentariosController;

$dashboard_controller = new DashboardController;
$comentarios_controller = new ComentariosController;
$counterTweets = 0;
$counterSeguindo = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard/style.css')?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
@foreach($userLogado as $user)
@endforeach
    <header id="main-header">
        <div class="content">
            <nav>
                <ul>
                    <li><a class="home" href="{{ url('dashboard/'.$user->id) }}">Home</a></li>
                </ul>
            </nav>

            <div class="side">
                <img src="../assets/avatar-svgrepo-com.svg" alt="">
                <a href="{{ url('login') }}">Logout</a>
            </div>
        </div>
    </header>
    <div class="banner">
        <h1>Twitter Neex</h1>
    </div>
    <div class="bar">
        <div class="content">
        <ul>
                @foreach($todosUsuarios as $todos)
                     @if($dashboard_controller->verificaSeguidor($todos->id, $user->id))
                        @php
                         $counterSeguindo++;
                        @endphp
                     @endif
                @endforeach

                <li>
                    <span>Seguindo</span>
                    <strong>{{$counterSeguindo++}}</strong>
                </li>

            </ul>
        </div>
    </div>

    <div class="wrapper-content content">
        <aside class="profile">
            <img class="avatar" src="../assets/avatar-svgrepo-com.svg" alt="avatar">
            <h1>{{$user->name}}</h1>
            <p>Desafio do twitter criado para Neex Brasil.</p>
        </aside>
        <section class="timeline">
            <nav>
                <a href="{{ url('dashboard/'.$user->id) }}">Todos os Tweets</a>
                <a href="{{ url('dashboardsecundaria/'.$user->id) }}">Tweets Seguidores</a>
            </nav>
            <ul class="tweets">
                @foreach($publicacoes as $publicacao)
                @if($dashboard_controller->verificaSeguidorPublicacaoPostagem($publicacao['user_id'], $user->id))
                <li>
                    <img src="../assets/avatar-svgrepo-com.svg" alt="avatar">
                        <div class="info">

                            <strong>{{$publicacao['name']}}</strong>
                            <p>{{$publicacao['texto_publicacao']}}</p>

                            <form action="{{route('criar_comentario', ['id' => $user->id ])}}" action="get">
                                <div class="comentar">
                                    <input type="text" name="id_postagem" value="{{$publicacao['id']}}" hidden>
                                    <textarea name="comentario" value="" id="" cols="30" rows="10" class="" required></textarea>
                                    <button>Enviar</button>
                                </div>
                            </form>
                            @foreach($comentarios as $comentario)
                                    @if($publicacao['id'] == $comentario->id_postagem)      
                                    <div class="carregar-comentarios">
                                        
                                            <strong>{{$comentario->name}}</strong>
                                            <p>{{$comentario->comentario}}t</p>
                                    
                                    </div>
                                    <div class="img-comments">
                                        <img id="comment-svg" src="../assets/comments.svg" alt="comments">
                                    </div class="img-coments">
                                    @else

                                    @endif
                            @endforeach
                        </div>
                 </li>
                @else
                @endif
                @endforeach
            </ul>
        </section>
        <aside class="widgets">
           
        </aside>
    </div>

    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <form  action="{{route('criar_publicacao', ['id' => $user->id])}}" method="POST">
          @csrf
            <div class="container-comments">

                    <strong>Novo Tweet</strong>
                    <textarea name="texto_publicacao" id="" cols="30" rows="10" class=""></textarea>
                </div>
                <div class="btn-enviar-comentario">
                    <button  type="submit"><strong>Enviar</strong></button>
                </div>
                </div>
          </form>

    </div>
</body>
</html>

<script type ="text/javascript" src="<?php echo asset('js/modaltwitar.js')?>"></script>
