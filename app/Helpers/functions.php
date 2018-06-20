<?php

function generatePassword()
{
    //Letras minúsculas embaralhadas
    $capitalLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
    //Letras maiúsculas embaralhadas
    $smallLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    //Números aleatórios
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;
    //Caracters Especiais
    $specialCharacters = str_shuffle('!@#$%*-');
    //Junta tudo
    $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;
    //Embaralha e pega apenas 8 caracters
    $password = substr(str_shuffle($characters), 0, 8);
    //Retorna a senha
    return $password;
}

function sanitizeString($string)
{
    // Valores informados
    $what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º', 'Ã', 'Õ', '&');
    // Valores a serem substituídos
    $by = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'E', 'I', 'O', 'U', 'n', 'n', 'c', 'C', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', 'A', 'O', '');
    // String Formatada
    return str_replace($what, $by, $string);
}

function createUrl($string)
{
    //Retira os acentos
    $url = sanitizeString($string);
    //Deixa o texto em minusculo retira todos encodes html
    return str_replace(' ', '-', strtolower(filter_var($url, FILTER_SANITIZE_FULL_SPECIAL_CHARS)) );
}

function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->level);
    foreach ($permissions as $key => $value) {
      if($value == $userAccess){
        return true;
      }
    }
    return false;
  }


  function getMyPermission($id)
  {
    switch ($id) {
      case 1:
        return 'admin';
        break;
      case 2:
        return 'student';
        break;
      default:
        return 'user';
        break;
    }
  }