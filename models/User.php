<?php

namespace models;

class User
{
    private $email;
    private $password;
    private $admin;//admin or client
    private $idUser;
    public function __construct($email,$password,$admin = false,$idUser='') {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setStatus($admin);
        $this->setId($idUser);
    }
    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getStatus(){
        return $this->admin;
    }

    public function getId(){
        return $this->idUser;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setStatus($admin){
        $this->admin = $admin;
    }

    public function setId($idUser){
        $this->idUser = $idUser;
    }
}
