<?php
/************************************************************************************
 * De estas clase se heredarán los controladores, esta clase carga EntidadBase,
 * ModeloBase y todos los modelos creados dentro del directorio model. 
*************************************************************************************/

class ControladorBase{

    public function __construct(){
        require_once 'EntidadBase.php';
        require_once 'ModeloBase.php';

        //Incluir todos los modelos
        foreach (glob("model/*.php") as $file) {
            require_once $file;
        }
    }

    //Plugins y funcionalidades

    /**
     * Este método lo que hace es recibir los datos del controlador en forma de ARRAY
     * los recorre y crea una variable dinámica con el indice asociativo y le da el
     * valor que contiene dicha posición del ARRAY, luego carga los helpers para las
     * vistas y carga la vista que le llega como parametro. En resumen un método para
     * renderizar vistas.
     */

     public function view($vista, $datos){
         foreach ($datos as $id_assoc => $valor) {
             ${$id_assoc} = $valor;
         }

         require_once 'core/AyudaVistas.php';
         $helper = new AyudaVistas();

         require_once 'view/'.$vista.'View.php';
     }

     public function redirect($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO){
         header("Location:index.php?controller=".$controlador."$action=".$accion);
     }
}

?>