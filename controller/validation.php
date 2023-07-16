<?php
function isValidUsername($username)
{
    $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';

    if(strlen($username) < 4) return false;

    for ($i = 0; $i < strlen($username); $i++) {
        $character = $username[$i];

        if (strpos($allowedCharacters, $character) === false) {
            return false;
        }
    }

    return true;
}

function isValidEmail($email)
{
    $atIndex = strpos($email, '@');
    $dotIndex = strrpos($email, '.');

    if ($atIndex === false || $dotIndex === false) {
        return false;
    }
    if ($atIndex === 0 || $dotIndex === (strlen($email) - 1)) {
        return false;
    }

    if (strpos($email, '..') !== false) {
        return false;
    }

    if (strpos($email, '.@') !== false) {
        return false;
    }

    if (strpos($email, '@.') !== false) {
        return false;
    }

    if (strpos($email, ' ') !== false) {
        return false;
    }

    return true;
}

function isValidName($name){

    if(strlen($name) < 3) return false;

    for ($i = 0; $i < strlen($name); $i++) {
        $character = $name[$i];

        if (!ctype_alpha($character) && $character !== ' ' && $character !== ' ') {
            return false;
        }
    }

    return true;
}

function isValidPassword($password){
    if(strlen($password) < 8) return false;
    return true;
}

function isValidPhone($phone, $region){
    $regions = array(
        'USA' => 1,
        'USA' => 1,
        'USA' => 1,
        'USA' => 1,
        'USA' => 1,
        'USA' => 1,
        'USA' => 1,
        'USA' => 1
    );

    if(strlen($phone) != $regions[$region]) return false;
    
    return true;
}

?>