<?php
    namespace dao\json;
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
            $this->showList = array();

            $jsonPath = $this->getJsonFilePath();
    
            // $jsonContent = file_get_contents('../Data/cinema.json');
            $jsonContent = file_get_contents($jsonPath);
    
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
    
            foreach ($arrayToDecode as $valueArray) {
                $projectionTime = $arrayToDecode['projectionTime'];
                $movie = //metodo parseo;
                $cinema = //metodo parseo;
                
                array_push($this->showList, $show);
        }
        
        private function saveData()
        {
            $arrayToEncode = array();

            foreach ($this->showList as $show) {
            //$valueArray['projectionTime'] = $show->getProjectionTime();
            $valueArray['day'] = $show->getDay();
            $valueArray['time'] = $show->getTime();
            $valueArray['movie'] = /*array(
                Aca va se invoca el metodo de daomovie de parseo
              )*/
            $valueArray['cinema'] = /*array(
                Aca va se invoca el metodo de daocinema de parseo
              )*/
            
            array_push($arrayToEncode, $valueArray);
        }
        $jsonPath = $this->getJsonFilePath();
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($jsonPath , $jsonContent);
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