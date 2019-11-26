<?php

namespace models;

class User
{
    private $email;
    private $password;
    private $role;//admin or client
    private $idUser
    
    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getRole(){
        return $this->role;
    }

    public function getId(){
        return $this->role;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function setId($idUser){
        $this->idUser = $idUser;
    }
}
