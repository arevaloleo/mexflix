<?php

class StatusModel extends Model {

    public function set($status_data = array() ){
        foreach ($status_data as $key => $value) {
            //variable de variable
             $$key = $value;
        }
        //status_id = al valor que se paso por parametro en el array al igual que el status= al valor que se paso
        $this->query = "REPLACE INTO status  VALUES(default,'$status')";
        $this->query;
        $this->set_query(); 
        
    }
    public function get($status_id = ''){ //no tiene nada que ver con el status de arriba
        $this->query  = ($status_id != '') ? "SELECT * FROM status WHERE status_id = $status_id" 
                                    : "SELECT * FROM status";
        $this->get_query();
        //var_dump($this->rows);
        $num_rows = count($this->rows);
        $data = array();
        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
            //$data[$key] = $value;
        }
        return $data;
        

    }
    public function del($status_id = ''){
        $this->query = "DELETE FROM status WHERE status_id = $status_id";
        $this->query;
        $this->set_query();

    }


   
}

?>