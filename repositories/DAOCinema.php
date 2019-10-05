<?php 
    namespace repositories;
    include ROOT.DIRECTORY_SEPARATOR.'config/'.'Autoload.php';

    use repositories\IDAO as IDAO;
    use models\Cinema as Cinema;

    class DAOCinema implements IDAO
    {
        private $cinemaList = array();

        public function add($newCinema){
            if ($newCinema instanceof Cinema){    
                $this->retrieveData();
                array_push($this->cinemaList, $newCinema);
                $this->saveData();
            }
            else{
                echo 'Error de tipo'.'<br>';
            }
        }

        public function getAll(){
            $this->retrieveData();
            return $this->cinemaList;
        }

        public function deleteById($id){
            $this->retrieveData();
            $newList = array();
            foreach ($this->cinemaList as $cinema) {
                if($cinema->getId() != $id){
                    array_push($newList, $cinema);
                }
            }
            $this->cinemaList = $newList;
            $this->saveData();
        }

        public function saveData(){
            $arrayToEncode = array();

            /*
             *cambiar los get con los correctos del modelo con las claves correspondientes del array 
             que serian los nombres de los atributos 
            */
            foreach ($this->cinemaList as $cinema) {
                $valueArray['id'] = $cinema->getId();
                $valueArray['name'] = $cinema->getName();
                $valueArray['description'] = $cinema->getDescription();
                $valueArray['type'] = $cinema->getType();

                array_push($arrayToEncode, $valueArray);

            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents('../data/cinema.json', $jsonContent);
        }

        public function retrieveData(){
            $this->cinemaList = array();

            $jsonPath = $this->GetJsonFilePath();

            // $jsonContent = file_get_contents('../Data/cinema.json');
            $jsonContent = file_get_contents($jsonPath);
            
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valueArray) {
                $cinema = new Cinema;
                //new Beer($valueArray['id'],$valueArray['name'],$valueArray['description'],$valueArray['type']);
                
                array_push($this->cinemaList, $cinema);
            }
        }

        //Es necesario para evitar los problemas de requires por el ruteo
        function GetJsonFilePath(){

            $initialPath = "data/cinema.json";
            if(file_exists($initialPath)){
                $jsonFilePath = $initialPath;
            }else{
                $jsonFilePath = "../".$initialPath;
            }

            return $jsonFilePath;
        }
    }
        }
    
?>