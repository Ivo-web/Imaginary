<?php 

         //Classe permettant d'utiliser l'API OpenWeather facilement
    class OpenWeather {
        
        private $apiKey;
      
                  //Le constructeur prend en paramètre une clef d'API
        public function __construct(string $apiKey)
        {
            $this->apiKey = $apiKey; 
        }



      /*Fontion permettant de se connecter à l'API et de retourner les données météo.
        Elle prend en paramètre le nom de la Ville*/
        public function getForecast(string $city)
        {
           if (isset($_POST['submit-weather'])) {
               if (!empty($_POST['city-weather'])) {
                   $_POST['city-weather'] = $city;

                $curl = curl_init("api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&lang=fr&appid={$this->apiKey}");
                
                $option = array(CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 5);
    
                 curl_setopt_array($curl, $option);
             
                $data = curl_exec($curl);
                if ($data === false OR curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
                     return null;

                } else {
                       
                           $data = json_decode($data, true);
                           return $data;
                     }
       
               }
           }
      
        
        }
    }
?>




<?php



