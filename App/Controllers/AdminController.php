<?php

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

class adminController extends Action{

        public function login(){
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
            $this->render("login", "layout1", "Login", false);
        }

        public function register(){
            $this->view->usuario = array(
                'name' => '',
                'surname' => '',
                'email' => ''
            );
            $this->view->erroCadastro = false;
            
            $this->render("register", "layout1", "Criar conta", false);
        }

        public function registrar(){
            $usuario = Container::getModel('Usuario');
            //receber dados do formulário
            $usuario->__set('name', $_POST['nome']);
            $usuario->__set('surname', $_POST['sobrenome']);
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('password', md5($_POST['password']));

            if($usuario->valCadastro() && count($usuario->getUserByEmail()) == 0){
                    $usuario->save();
                    $this->render('cadastro', 'layout1', 'Sucesso', false);
            }else{
                $this->view->usuario = array(
                    'name' => $_POST['nome'],
                    'surname' => $_POST['sobrenome'],
                    'email' => $_POST['email']
                );
                $this->view->erroCadastro = true;
                $this->render("register", "layout1", "Criar conta", false);
            }

        }

        public function admin(){
            session_start();
            $this->validaAuth(); //validar auth do usuário

            $this->getInfoUser();  //info do user auth    

            $this->render("index", "layout_admin", "Dashboard", false);
        }

        public function logout(){
            session_start();
            session_destroy();
            header('Location: /');
        }

        public function calendar(){
            session_start();

            $this->validaAuth(); //validar auth do usuário        
            $this->getInfoUser(); //info do user auth

            $this->view->dados['city'] = $_GET['city'] ?? "1";
            
            $this->render("calendar", "layout_admin", "Calendário", true);
        }

        public function commitments(){
            $this->render("commitments", "layout_admin", "Compromissos", true);
        }

        public function listEvents(){
            session_start();
            $this->validaAuth(); //validar auth do usuário           

            $agendar = Container::getModel('Agendamento'); 

            $agendar->__set('city', $_GET['city']);

            $agendar->listEvents();
        }


        public function pageNotFound(){
            session_start();
            $this->validaAuth(); //validar auth do usuário
        
            $this->getInfoUser(); //info do user auth
            $this->render("404", "layout_admin", "Página não encontrada", true);
        }

        public function validaAuth(){
            if(!isset($_SESSION['id']) || $_SESSION['id'] == '' && !isset($_SESSION['name']) || $_SESSION['name'] == '' || !isset($_SESSION['surname']) || $_SESSION['surname'] == ''){
                header('Location: /login?login=erro');
            }
        }

        //recuperar info dos users
        public function getInfoUser(){
            $usuario = Container::getModel('Usuario');
            $usuario->__set('id',$_SESSION['id']);
            return $this->view->getInfoUser = $usuario->getInfoUser(); //info do user auth
        }

        //pegardados por id
        public function getDataById(){
            session_start();
            $this->validaAuth(); //validar auth do usuário
            
            $agendar = Container::getModel('Agendamento'); 
            $agendar->__set('id', $_GET['id'] ?? "null");

            $agendar->getDataById();

        }
    }
    
?>