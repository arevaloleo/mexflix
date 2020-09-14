<?php
class Router {
    public $route;

    public function __construct($route){
        $session_options = array(
            'use_only_cookies' => 1, 
            'auto_start' => 1,
            'read_and_close' => true
        );
      if (!isset($_SESSION)) session_start([$session_options]);
        if (!isset($_SESSION['ok']))  $_SESSION['ok'] = false;
        

        if ( $_SESSION['ok'] ) {
            $this->route = (isset($_GET['r'])) ? $_GET['r'] : 'home';
            $controller = new ViewController();
            switch ($this->route) {
                case 'home' : 
                    $controller->load_view('home');

                break;

                case 'movieseries' : 
                    
                    $controller->load_view('movieseries');
                break;
                case 'usuarios' : 
                    if ( !isset($_POST['r']) ) $controller->load_view('users');
                    
                    else if( $_POST['r'] == 'users-add' ) {
                        $controller->load_view('users-add');
                    }
                    else if( $_POST['r'] == 'users-edit' ) {
                        $controller->load_view('users-edit');
                    }
                    else if( $_POST['r'] == 'users-delete' ) {
                        $controller->load_view('users-delete');
                    }

                break;

                case 'status' : 
                    if ( !isset($_POST['r']) ) $controller->load_view('status');
                    
                    else if( $_POST['r'] == 'status-add' ) {
                        $controller->load_view('status-add');
                    }
                    else if( $_POST['r'] == 'status-edit' ) {
                        $controller->load_view('status-edit');
                    }
                    else if( $_POST['r'] == 'status-delete' ) {
                        $controller->load_view('status-delete');
                    }

                break;

                case 'salir' : 
                    $user_session = new SessionController();
                   $user_session->logout();
                break;
                default:
                    $controller->load_view('error404');
                break;
            
        } } else {
            if (!isset($_POST['user']) && !isset($_POST['password'])){
            //mostrar formulario de autenticacion;
            $login_form = new ViewController();
            $login_form->load_view('login');
            }
            else {
                $user_session = new SessionController();

                $session = $user_session->login($_POST['user'],$_POST['password']);
                if (empty($session)){

                    //usuario y password incorrectos 
                    $login_form = new ViewController();
                    $login_form->load_view('login');
                    header('Location: ./?error=El usuario '. $_POST['user'] . ' y/o la clave son incorrectas');
                }
                else {
                    $_SESSION['ok'] = true;

                    foreach ($session as $row){
                        $_SESSION['user'] = $row['user']; //guarda en variable de session por ser persistente
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['birthday'] = $row['birthday'];
                        $_SESSION['pass'] = $row['pass'];
                        $_SESSION['role'] = $row['role'];
                    }
                    header('Location: ./');
                }
            }

        }
    }

}