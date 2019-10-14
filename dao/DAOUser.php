<?php
namespace dao;

use dao\IDAOUser as IDAOUser;
use models\User as User;

class DAOUser implements IDAOUser
{
    private $userList;
    
    public function add($newUser)
    {
        $this->retrieveData();
        array_push($this->userList, $newUser);
        $this->saveData();
    }

    public function getAll()
    {
        $this->retrieveData();
        return $this->userList;
    }

    public function getByEmail($email)
    {
        $this->retrieveData();
        foreach ($this->userList as $User) {
            if ($User->getEmail() == $email) {
                return $User;
            }
        }
    }

    private function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->userList as $User) {
            $valueArray['email'] = $User->getEmail();
            $valueArray['password'] = $User->getPassword();
            $valueArray['role'] = $User->getRole();
            $valueArray['ticketPrice'] = $User->getTicketPrice();

            array_push($arrayToEncode, $valueArray);
        }
        $jsonPath = $this->getJsonFilePath();
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($jsonPath , $jsonContent);
    }

    private function retrieveData()
    {
        $this->userList = array();

        $jsonPath = $this->getJsonFilePath();

        // $jsonContent = file_get_contents('../Data/User.json');
        $jsonContent = file_get_contents($jsonPath);

        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

        foreach ($arrayToDecode as $valueArray) {
            $User = new User($valueArray['email'],$valueArray['password'],
                    $valueArray['role']);
            $User->setId($valueArray['id']);
            
            array_push($this->userList, $User);
        }
    }

    private function getJsonFilePath()
    {
        $jsonFilePath = ROOT."data/User.json";
        if (!file_exists($jsonFilePath))
            file_put_contents($jsonFilePath,"");
        return $jsonFilePath;
    }
}
