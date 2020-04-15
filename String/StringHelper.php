<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 02/01/2015
 * Time: 23:53
 */

namespace Alcatraz\Components\String;


class StringHelper
{
    public static function Contains($string, $contains)
    {
        return (strpos($string, $contains) !== FALSE);
    }

    public static function ApenasNumeros($string)
    {
        return preg_replace("/[^0-9]/", "", $string);
    }

    public static function RemoveAcentos($string)
    {
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr-"!´@#$%&*()_+={[}]/?;:.,\\\'<>º^';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-                                ';
        $string = utf8_decode($string);
        $string = strtr($string, utf8_decode($a), $b);
        $string = strip_tags(trim($string));
        $string = str_replace(" ", "", $string);

        return strtolower(utf8_encode($string));
    }

    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    public static function maskCNPJorCPF($doc)
    {
        if($doc == "" || $doc == null)
            return $doc;

        $maskCNPJ = "##.###.###/####-##";
        $maskCPF = "###.###.###-##";

        if (strlen($doc) > 13)
            return self::mask($doc, $maskCNPJ);

        return self::mask($doc, $maskCPF);
    }

    public static function maskMoney($valor){
        return number_format($valor, 2, ',', '.');
    }

    public static function calcPorcentagem($item, $soma){
        if($soma == 0)
            return 0;

        return ($item / $soma) * 100;
    }
}