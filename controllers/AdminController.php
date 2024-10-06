<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController{

    
      public static function index( Router $router ){
        session_start();

        isAdmin();

        $fecha = $_GET['fecha'] ??  date('Y-m-d') ;  //recibe la fecha seleccionada, si no hay nada toma la fecha actual del servidor
        $fechas = explode('-', $fecha);

        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){
             header('location: /404');   //lo envia a error cuando mete una fecha en el buscador que es invalida
        }

        
        

        //consultar base de datos  codigo de consukta de mysql enfocado a php
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";  //aquí nos trae los datos donde se cumple la condicion

        $citas =  AdminCita::SQL($consulta);

        

        $router->render('admin/index', [
                 'nombre' => $_SESSION['nombre'],
                 'citas' => $citas,
                 'fecha' => $fecha  //pasa las vasriable a,la vista de index
        ]);
      }


}