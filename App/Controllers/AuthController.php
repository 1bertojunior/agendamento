<?php

    namespace App\Controllers;

    //os recursos do miniframework
    use MF\Controller\Action;
    use MF\Model\Container;

    class AuthController extends Action {

        public function autenticar(){

            $usuario = Container::getModel('Usuario');

            $usuario->__set('email', $_POST['email']);
            $usuario->__set('password', md5($_POST['password']));

            $usuario->auth();     
            
            if(@$usuario->__get("id") && $usuario->__get('name') && $usuario->__get('surname')){
                session_start();
                $_SESSION['id'] = $usuario->__get("id");
                $_SESSION['name'] = $usuario->__get("name");
                $_SESSION['surname'] = $usuario->__get("surname");

                header('Location: /admin');
                
            }else{
                header('Location: /login?login=erro');
            }

        }

    }


?>