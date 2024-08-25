<?php

namespace Model;

  class Usuario extends ActiveRecord{
      //Base de datos
      protected static $tabla = 'usuarios';
      protected static $columnasDB = ['id','nombre','apellido','email','password',
      'telefono','admin','confirmado','token' ];

      public $id;
      public $nombre;
      public $apellido;
      public $email;
      public $password;
      public $telefono;
      public $admin;
      public $confirmado;
      public $token;

      public function __construct($args = [])
       {
         $this ->id=$args['id'] ?? null;  //[arreglo asociativo]
         $this ->nombre=$args['nombre'] ?? '';   
         $this ->apellido=$args['apellido'] ?? '';   
         $this ->email=$args['email'] ?? '';   
         $this ->password=$args['password'] ?? '';   
         $this ->telefono=$args['telefono'] ?? '';   
         $this ->admin=$args['admin'] ?? '0';   
         $this ->confirmado=$args['confirmado'] ?? '0';        
         $this ->token=$args['token'] ?? '';  
        }

 

  //mensajes de validacion para crear cuenta

  public function validarNuevaCuenta(){
    if(!$this->nombre){//si no esta el nombre ocurre alerta
              self::$alertas['error'] [] = 'El Nombre del Cliente es Obligatorio';
     }
    if(!$this->apellido){
            self::$alertas['error'] [] = 'El Apellido del Cliente es Obligatorio';
     }

    if(!$this->email){
            self::$alertas['error'] [] = 'El Email del Cliente es Obligatorio';
     }

    if(!$this->password){
            self::$alertas['error'] [] = 'La Clave del Cliente es Obligatoria';
     }

     if($this->password)  {
        if(strlen($this->password) <6){
           self::$alertas['error'] [] = 'La Clave debe tener almenos 6 caracteres ';
         }
            

     }    //strlen arroja longitud del string
       
    return self::$alertas;   

  }

 public function validarLogin(){
    if(!$this->email){
        self::$alertas['error'][] = 'Su Correo es Obligatorio'; 
        }
      if(!$this->password){
      self::$alertas['error'][] = 'La Clave es Obligatoria'; 
      }

    return self::$alertas;


  }

  public function validarEmail(){
    if(!$this->email){
      self::$alertas['error'][] = 'Su Correo es Obligatorio'; 
      }
      return self::$alertas;

  }

  public function validarPassword(){
       if(!$this->password){

         self::$alertas['error'][] = 'La Clave es Obligatoria'; 
       }

       if(strlen($this->password) < 6){
        self::$alertas['error'][] = 'Mínimo 6 Caracteres'; 

       }

       return self::$alertas;

  }
           //revisa si el usuario ya existe
  public function existeUsuario() {
    $query = "SELECT  * FROM " . self::$tabla . " WHERE email = '". $this->email. "' LIMIT 1";
      
    $resultado = self::$db->query($query );

    if($resultado->num_rows){
          self::$alertas['error'][] = 'El usuario ya está registrado';
      }

  return $resultado;
      
 }
      
   
 public function hashClave() {
               
             $this->password = password_hash($this->password, PASSWORD_BCRYPT);
     
 }

        
     
 public function crearToken() {
   $this->token = uniqid();

 }

   public function comprobarPasswordAndVerificado($password){
    $resultado = password_verify($password, $this->password);

    

    if(!$resultado || !$this->confirmado){

      
       self::$alertas['error'][] = 'Clave Incorrecta o Cuenta no Confirmada';

    }else{
      
      return true;

    }

  }

            
}


 