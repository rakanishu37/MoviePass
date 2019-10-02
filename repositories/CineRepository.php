<?php 
    namespace repositories;
    include $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'tp'.DIRECTORY_SEPARATOR.'autoload.php';

    use repositories\IRepository as IRepository;
    use models\Cine as Cine;
/*
Revisar bien que coincidan los nombres porque copy paste del tp
*/
    class CineRepository implements IRepository
    {
        private $cineList = array();

        public function agregar($nuevoCine){
            if ($nuevoCine instanceof Cine){    
                $this->retrieveData();
                array_push($this->cineList, $nuevoCine);
                $this->saveData();
            }
            else{
                echo 'Error de tipo'.'<br>';
            }
        }

        public function getAll(){
            $this->retrieveData();
            return $this->cineList;
        }

        public function borrarPorId($id){
            $this->retrieveData();
            $newList = array();
            foreach ($this->cineList as $cine) {
                if($cine->getId() != $id){
                    array_push($newList, $cine);
                }
            }
            $this->cineList = $newList;
            $this->saveData();
        }

        public function saveData(){
            $arrayToEncode = array();

            /*
             *cambiar los get con los correctos del modelo con las claves correspondientes del array que serian los nombres de los atributos 
            */
            foreach ($this->cineList as $cine) {
                $valueArray['id'] = $cine->getId();
                $valueArray['name'] = $cine->getName();
                $valueArray['description'] = $cine->getDescription();
                $valueArray['type'] = $cine->getType();

                array_push($arrayToEncode, $valueArray);

            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents('../Data/cine.json', $jsonContent);
        }

        public function retrieveData(){
            $this->cineList = array();

            $jsonPath = $this->GetJsonFilePath();

            // $jsonContent = file_get_contents('../Data/cine.json');
            $jsonContent = file_get_contents($jsonPath);
            
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valueArray) {
                $cine = new Cine
                //new Beer($valueArray['id'],$valueArray['name'],$valueArray['description'],$valueArray['type']);
                
                array_push($this->cineList, $cine);
            }
        }

        //Es necesario para evitar los problemas de requires por el ruteo
        function GetJsonFilePath(){

            $initialPath = "Data/cine.json";
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