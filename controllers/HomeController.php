<?php
namespace controllers;
// use \DateTime as DateTime;
// use \DateInterval as DateInterval;

    class HomeController
    {
        public function index(){
			if(session_status() !== PHP_SESSION_ACTIVE) session_start();
			if(isset($_SESSION['loggedUser'])){
				include_once VIEWS.'menuTemporal.php';
			}
			else{
				include VIEWS.'loginForm.php';
			}
        }

        public function metodo(){
			var_dump($_POST);
			/*$b= array();
			$a = array("a","b","c","d","e");
			foreach ($a as $value) {
				
				if($value != 'b' && $value != 'd' && $value != 'f'){
					echo $value.'<br>';	
					array_push($b,$value);
				}
					
			}
			var_dump($b);
			/*if(1<0){
				echo 'adentro del if';
			}
			elseif (2>1) {
				echo 'adentro del else que tiene un if';
			}
			
			
			$date = new DateTime('2000-12-31 12:00');
			$dateEnd = new DateTime('2000-12-31 12:00');
			echo $date->format('Y-m-d H:i') . '<br>';
			$tiempo = 128 + 15;
			$interval = new DateInterval('PT'.$tiempo.'M');

			$dateEnd->add($interval);
			echo $dateEnd->format('Y-m-d H:i') . '<br>';
			
			$date2 = new DateTime('2000-12-31 14:24');
			echo $date2->format('Y-m-d H:i') . '<br>';
		
			if($date2>=$date && $date2<=$dateEnd){
				echo 'se zarpo';
			}
			else{
				echo 'cumple con lso 15 min';
			}*/
        }
    }
    
?>