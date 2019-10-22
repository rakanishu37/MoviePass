<?php
    namespace dao;
    use models\User as User;
    
    interface IDAOUser {

        function add(User $value);
        function getAll();
    
    }
?>
