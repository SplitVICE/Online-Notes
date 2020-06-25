<?php

function sha512_hashing($input)
{
    return hash("sha512", $input);
}

function sha512_hashing_rounds($input, $rounds)
{
    $result = $input;

    for($i = 0; $i <= $rounds; $i++){
        $result = hash("sha512", $result);
    }

    return $result;
}

function sha512_compare($salt, $input1, $input2)
{
    return hash("sha512", $input1) == hash("sha512", $input2);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}