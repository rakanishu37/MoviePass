<?php
namespace controllers;

    class GenreController
    {   
        /**
        *Retorna en caso de exito el listado de los generos
        */
        public function getGenreList(){
            return $this->retriveGenreList();
        }

        private function retriveGenreList(){
            //inicia la session cURL
            $curl = curl_init();

            //setea las variables
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.themoviedb.org/3/genre/movie/list?language=en-US&api_key=783ce81a4a4455d3719eb5ca1f039861",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            ));

            //Ejecuta la sesion y guarda en response lo que devuelva
            $response = curl_exec($curl);

            //Se guarda en err el error si es que hubo alguno
            $err = curl_error($curl);

            //se cierra la sesion
            curl_close($curl);

            if ($err) echo "cURL Error #:" . $err;
            else return $response;
            
        }
    }

?>