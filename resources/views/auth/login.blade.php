<?php

//include 'config.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';

//require 'vendor/PHPMailer/src/Exception.php';
//require 'vendor/PHPMailer/src/PHPMailer.php';
//require 'vendor/PHPMailer/src/SMTP.php';

session_start();

error_reporting(0);

if (isset($_SESSION["user_id"])) {
  header("Location: /");
}

if (isset($_POST["signup"])) {
  $full_name = mysqli_real_escape_string($conn, $_POST["signup_full_name"]);
  $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["signup_password"]));
  $cpassword = mysqli_real_escape_string($conn, md5($_POST["signup_cpassword"]));
  $token = md5(rand());

  $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));

  if ($password !== $cpassword) {
    echo "<script>alert('La contraseña no coincidió.');</script>";
  } elseif ($check_email > 0) {
    echo "<script>alert('El correo electrónico ya existe en nuestra base de datos.');</script>";
  } else {
    $sql = "INSERT INTO users (full_name, email, password, token, status) VALUES ('$full_name', '$email', '$password', '$token', '0')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $_POST["signup_full_name"] = "";
      $_POST["signup_email"] = "";
      $_POST["signup_password"] = "";
      $_POST["signup_cpassword"] = "";

      $to = $email;
      $subject = "Verificación de correo electrónico";

      $message = "
      <html>
      <head>
      <title>{$subject}</title>
      </head>
      <body>
      <p><strong>Querido {$full_name},</strong></p>
      <p>¡Gracias por registrarte! Verifica tu correo electrónico para acceder a nuestro sitio web. Haga clic debajo del enlace para verificar su correo electrónico.</p>
      <p><a href='{$base_url}verify-email.php?token={$token}'>Verificar correo</a></p>
      </body>
      </html>
      ";

      //Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $smtp['host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $smtp['user'];                     //SMTP username
        $mail->Password   = $smtp['pass'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $smtp['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($my_email);
        $mail->addAddress($email, $full_name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo "<script>alert('Hemos enviado un enlace de verificación a su correo electrónico. - {$email}.');</script>";
      } catch (Exception $e) {
        echo "<script>alert('Correo no enviado. Inténtalo de nuevo.');</script>";
      }
    } else {
      echo "<script>alert('Registro de usuario fallido.');</script>";
    }
  }
}

if (isset($_POST["signin"])) {
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

  $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' AND password='$password' AND status='1'");

  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $_SESSION["user_id"] = $row['id'];
    header("Location: welcome.php");
  } else {
    echo "<script>alert('Los datos de inicio de sesión son incorrectos. Inténtalo de nuevo.');</script>";
  }
}

?>




@extends('pages.app')
@section('title','Login')

@section('content')

  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="post" class="sign-in-form">
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
        <form action="" class="sign-up-form" method="post">
          <img src="{{asset('public/img/logo.png')}}" width="300" class="img-fluid">            
          <h2 class="title">Registrarse</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Nombres" name="signup_full_name" value="" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Correo" name="signup_email" value="" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="signup_password" value="" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirma Password" name="signup_cpassword" value="" required />
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