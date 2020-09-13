<?php
class SessionController {
    private $session;

    public function __construct()
    {
        $this->session = new UserModel();
    }
    public function login($user, $password){
        return $this->session->validate_user($user,$password);

    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: ./');

    }

}