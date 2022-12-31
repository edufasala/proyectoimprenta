@extends('pages.app')
@section('title','Login')

@section('content')

  <div class="container">
    <div class="forms-container">
        @error('exito')
            {{ $exito }}
        @enderror
      <div class="signin-signup">
        <form action="{{ route('login') }}" method="post" class="sign-in-form">
            @csrf
          <img src="{{asset('public/img/milogo.png')}}" width="300" class="img-fluid">
          <h2 class="title">Iniciar Sesión</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
               <input type="text" placeholder="Correo electronico" name="email" value="" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" value="" required />
          </div>
          <input type="submit" value="Login" name="signin" class="btn solid" />
          <p style="display: flex;justify-content: center;align-items: center;margin-top: 20px;"><a href="{{route('recuperar.index')}}" style="color: #4590ef;">Recuperar Password?</a></p>
        </form>
        <form action="{{ route('register') }}" class="sign-up-form" method="post">
            @csrf
          <img src="{{asset('public/img/logo.png')}}" width="300" class="img-fluid">
          <h2 class="title">Registrarse</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Nombres" name="name" id="name" value="" >
            @error('name')
                <span class="invalidad-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Correo" name="email" id="email" value="" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" id="password" value="" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirma Password" name="password_confirmation" id="password_confirmation" value="" />
          </div>
          <input type="submit" class="btn" name="signup" value="Registrarse" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Eres nuevo?</h3>
          <p>
            Bienvenido, gracias por visitarnos puede darle click al boton para crearse una cuenta!
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Registrarse
          </button>
        </div>
        <img src="{{asset('public/img/log.png')}}" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Eres de los nuestros?</h3>
          <p>
            Hola estas de regreso, click en el boton para iniciar tu sesión.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Inicia Sesión
          </button>
        </div>
        <img src="{{asset('public/img/register.png')}}" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <script src="{{asset('public/js/script.js')}}"></script>



@endsection
