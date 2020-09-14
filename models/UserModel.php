<?php

class UserModel extends Model {

    public function set($user_data = array() ){
        foreach ($user_data as $key => $value) {
            //variable de variable
             $$key = $value;
        }
        //status_id = al valor que se paso por parametro en el array al igual que el status= al valor que se paso
        $this->query = "REPLACE INTO users  VALUES('$user','$email','$name','$birthday', MD5('$pass'), '$role')";
        
        $this->set_query(); 
        
    }
    public function get($user = ''){ //no tiene nada que ver con el status de arriba
        $this->query  = ($user != '') ? "SELECT * FROM users WHERE user = '$user'" 
                                    : "SELECT * FROM users";
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
    public function del($user = ''){
        $this->query = "DELETE FROM users WHERE user = '$user'";
        $this->set_query();

    }

    public function validate_user($user,$password){
        $this->query = "SELECT * FROM users WHERE user='$user' AND pass= MD5('$password')";
        $this->get_query();
        $data = array();

        foreach ($this->rows as $key => $value ){
            array_push($data,$value);
        }
        return $data;
    }



   
}

