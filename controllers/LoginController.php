<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;


class LoginController {
       public static function login(Router $router) {

           $alertas=[];

            if($_SERVER['REQUEST_METHOD']==='POST'){
               $auth = new Usuario($_POST);

               $alertas = $auth->validarLogin();

               if(empty($alertas)){
                    //verificar existencia de usuario
                    $usuario = Usuario::where('email', $auth->email);
                    
                      if($usuario){
                        //verifica clave
                         if( $usuario->comprobarPasswordAndVerificado($auth->password)){
                                 //autenticar usuario
                               session_start();

                               $_SESSION['id'] = $usuario->id;
                               $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                               $_SESSION['email'] = $usuario->email;
                               $_SESSION['login'] = true;

                               //redireccionamiento

                               if($usuario->admin === "1"){
                                    $_SESSION['admin'] = $usuario->admin ?? null;
                                    header('Location: /admin');

                                  } else{
                                    header('Location: /cita');
                                  }

                               
                         } 
                      }
                      else{
                        Usuario::setAlerta('error', 'Usuario Inexistente');
                      }

                 }
               
            }

            $alertas = Usuario::getAlertas();


            $router->render('auth/login',[
              'alertas'=> $alertas         
             ]);
      }

       public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /'); //redirecciona al usuario 
      }

       public static function olvide(Router $router) {
         $alertas = [];

         if($_SERVER['REQUEST_METHOD'] === 'POST'){
             $auth = new Usuario($_POST);
             $alertas = $auth->validarEmail();

             if(empty($alertas)){
                  $usuario = Usuario::where('email', $auth->email);
                  
                  if($usuario && $usuario->confirmado==="1"){
                      //crear token
                      $usuario->crearToken();
                      $usuario->guardar();  //update en la base de datos
                      //enviar e-mail

                      $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                      $email->enviarInstrucciones();

                      //mensaje de exito

                      Usuario::setAlerta('exito', 'Revise Su Correo');
                      
                     

                  }else{

                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado');
                   
                  }

             } $alertas= Usuario::getAlertas();


         }


        $router->render('auth/olvide-password',[
              'alertas' => $alertas
        ]);
      }
 
      public static function recuperar(Router $router) {

        $alertas = [];
        $error = false;

        $token = s($_GET['token']);
        
        //Hallar usuario por token en la base de datos
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
          Usuario::setAlerta('error', 'Token Inválido');
          $error = true;  //si hay error no muestra formulario, conectado a recuperar auth linea10
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
             //obtener nueva clave y almacenarla
             $password = new Usuario($_POST);

             $alertas = $password->validarPassword();

             if(empty($alertas)){

                $usuario->password = null; //vacia la clave anterior
                
                $usuario->password = $password->password;
                $usuario->hashClave(); 
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if($resultado){
                    header('Location: /');  //lo envia a login

                }
                 //debuguear($usuario);

             }


        } 

        $alertas= Usuario::getAlertas();



        $router->render('auth/recuperar-password',[
          'alertas' =>$alertas,
          'error' => $error
        ]);
       }
      
       public static function crear(Router $router) {

        $usuario = new Usuario();

        //alertas vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){

          $usuario->sincronizar($_POST); //mantiene valor al recargar
          $alertas =  $usuario->validarNuevaCuenta();

          //revisar que alertas esté vacio
          if(empty($alertas)){
            $resultado= $usuario->existeUsuario();

             if($resultado->num_rows){
                  $alertas = Usuario::getAlertas();
             } else{
                 //no está registrado
                 //hashclave
                 $usuario->hashClave();
                 //Generar token
                 $usuario->crearToken();
                 //Enviar email
                 $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                 $email-> enviarConfirmacion();
                 

                 //crear usuario
                 $resultado = $usuario->guardar();

                 if($resultado){
                     header('Location: /mensaje'); 

                 }

                 //debuguear($usuario);

             }
            
          }

          
            

        }
        
         $router->render('auth/crear-cuenta',[
                 'usuario' => $usuario,
                 'alertas' => $alertas
         ]);
       }

         
      public static function mensaje(Router $router){
        $router->render('auth/mensaje');

      }

      public static function confirmar(Router $router){

          $alertas=[];

          $token  =s($_GET['token']);  //sanitiza la entrada
          
          $usuario = Usuario::where('token', $token);
          
          if(empty($usuario)){
                //mostrar error
                Usuario::setAlerta('error', 'Token No Válido');

          } else{
              //estado de usuario = confirmado
               
               $usuario->confirmado = "1";
               $usuario->token= null;
               $usuario->guardar();
               Usuario::setAlerta('exito', 'Cuenta Validada Correctamente');
          }
          
           $alertas = Usuario::getAlertas();
 
           $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
           ]);
      }
    
}


