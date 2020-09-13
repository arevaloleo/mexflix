<?php
abstract class Model {
    //atributos
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_password = '';
    private static $db_name = 'mexflix';
    //protected $db_name;
    private static $db_charset = 'utf8';
    private $conn;
    protected $query;
    protected $rows = array();

    
    //metodos


    //metodos abstractos para crud
    
    abstract protected function set();
    abstract protected function get();
    abstract protected function del();

    //privado apra conectarme a la base de datos
    private function db_open(){
        $this->conn = new mysqli(self::$db_host,
                                self::$db_user,
                                self::$db_password,
                                self::$db_name
        );
        $this->conn->set_charset(self::$db_charset);
    }

    //privado apra conectarme a la base de datos
    private function db_close(){
        $this->conn->close();
    }
    //establecer un query simple del tipo insert,delete update 
    protected function set_query() {
        $this->db_open();
        $this->conn->query($this->query);
        $this->db_close();
    }
    //obtener datos de un query
    protected function get_query(){
        $this->db_open();
        $result = $this->conn->query($this->query);
        while ($this->rows[] = $result->fetch_assoc());
        $result->close();
        $this->db_close();
        
        return array_pop($this->rows); //elimina el ultimo elemento del arreglo, ya que es un nulo  
        
    }

}
