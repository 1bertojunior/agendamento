<?php

    namespace App\Models;
    use MF\Model\Model;

    class Usuario extends Model{

        private $id;
        private $name;
        private $surname;
        private $email;
        private $password;

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            $this->$attr = $value;
        }

        //salvar
        public function save(){

            $query = "INSERT INTO users(name, surname, email, password) VALUES (:name, :surname, :email, :password)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':name', $this->__get('name'));
            $stmt->bindValue(':surname', $this->__get('surname'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':password', $this->__get('password'));

            $stmt->execute();
            return $this;

        }

        //validar se cadastro pode ser feito
        public function valCadastro(){
            $val = true;

            if(strlen($this->__get('name')) <= 3 || strlen($this->__get('surname')) <= 3) $val = false;
            if(strlen($this->__get('email')) <= 5) $val = false;
            if(strlen($this->__get('password')) < 3) $val = false;

            return $val;
        }

        //recupar um usuário por e-mail
        public function getUserByEmail(){
            $query = "SELECT name, email FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function auth(){
            $query = "SELECT id, name, surname, email FROM users WHERE :email = email AND :password = password ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':password', $this->__get('password'));
            $stmt->execute();

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            if(!empty($usuario)){
                $this->__set('id', $usuario['id']);
                $this->__set('name', $usuario['name']);
                $this->__set('surname', $usuario['surname']);
            }

            return $this;
        }

        //info do user auth
        public function getInfoUser(){
            $query = "SELECT name, surname FROM users WHERE id = :id_user";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_user', $this->__get('id'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);

        }

    }

?>