<?php
    namespace dao;
    
    use models\Theather as Theather;
    
    interface IDAOTheather {

        function add(Theather $value);
        function getAll();
    }
    
?>