<?php
/************************************************************************************
* De esta clase heredarán los modelos que representen entidades, en el constructor 
* le pasaremos el nombre de la tabla y tendremos tantos métodos como queramos para 
* ayudarnos con las peticiones a la BD a través de los objetos que iremos creando. 
* Lo bueno que tiene es que estos métodos pueden ser reutilizados en otras clases 
* ya que le indicamos la tabla en el constructor.
**************************************************************************************/

class EntidadBase{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table){
        $this->table = (string) $table;

        require_once 'Conectar.php';
        $this->conectar = new Conectar();
        $this->db = $this->conectar->conexion();
    }

    public function getConectar(){
        return $this->conectar();
    }

    public function db(){
        return $this->db;
    }

    public function getAll(){
        $query = $this->db->query("SELECT * FROM $this->table ORDER BY id DESC");

        //Devolvemos el resultSet en forma de arrar de objetos
        while ($row = $query->fetch_object()){
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    public function getById($id){
        $query = $this->db->query("SELECT * FROM $this->table WHERE id = $id");

        if ($row = $query->fetch_object()) {
            $resultSet = $row;
        }

        return $resultSet;
    }

    public function getBy($column, $value){
        $query = $this->db->query("SELECT * FROM $this->table WHERE $column = '$value'");

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return  $resultSet;
    }

    public function deleteById($id){
        $query = $this->db->query("DELETE FROM $this->table WHERE id = $id");
        return $query;
    }

    public function deleteBy($column, $value){
        $query = $this->db->query("DELETE FROM $this->table WHERE $column='$value'");
        return $query;
    }

    /*
     * Aquí podemos crear un montón de métodos que nos ayuden
     * a realizar operaciones con la base de datos de la entidad
     */
}

?>