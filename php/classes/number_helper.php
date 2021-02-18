<?php

//Classe permettant de reformatter facilement des nombres 
class NumberHelper {


    /*Fonction permettant de formater un nombre et de le retourner sous forme de money
      Elle prend en paramètre un nombre, ainsi que le sigle de la money*/
    public static function money_Format(float $number, string $sigle = '$'):string
    {
        return number_format($number, 0, '', ' ') . ' ' . $sigle;
    }

    
}