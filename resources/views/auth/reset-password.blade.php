@extends('pages.app')
@section('title','Registro')

@section('content')

    <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="{{ route('password.update') }}" method="post" class="sign-in-form">
            @csrf
            <input type="hidden" name="token" value="{{$request->route('token')}}">
            <h2 class="title">Recupera Password</h2>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="email" placeholder="Email Address" name="email" id="email" value="{{ $request->email }}" required />
            </div>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="password" placeholder="Contraseña" name="password" id="password" value="" required />
            </div>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="password" placeholder="Confirmar contraseña" name="password_confirmation" id="password_confirmation" value="" required />
            </div>
            <input type="submit" value="Actualizar" name="resetPassword" class="btn solid"  />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Recuperar Password ?</h3>
          <p>
            Si quieres recuperar tu password estas en el lugar correcto!
            <a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="{{ URL::previous() }}"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Atras </a>
          </p>
        </div>
        <img src="{{asset('public/img/register.png')}}" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <script src="{{asset('public/js/script.js')}}"></script>

@endsection
