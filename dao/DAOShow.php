<?php
    namespace dao;
    use models\Movie as Movie;
    use models\Genre as Genre;
    use models\Cinema as Cinema;
    use models\Show as Show;


    //array map posiblemente sirva aca
    class DAOShow implements IDAOShow
    {
        private $showList;

        public function add(Show $movie)
        {
            $this->retrieveData();
            array_push($this->showList, $movie);
            $this->saveData();
        }

        private function retrieveData()
        {
            
        }
        
        private function saveData()
        {

        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->showList;   
        } 
        
        private function getJsonFilePath()
        {
            $jsonFilePath = ROOT."data/shows.json";
            if (!file_exists($jsonFilePath))
                file_put_contents($jsonFilePath,"");
            return $jsonFilePath;
        }
    }
?>