<?php

// Encrypts the input string given in AES128.
// Returns the result.
function AES128_encrypt($string_input)
{
    $encryption_key = $_ENV['onlinenotes_master_key'];
    $ciphering = "AES-128-CTR";
    $string_to_encrypt = $string_input;

    $options = 0;
    $encryption_iv = '1234567891011121';

    return openssl_encrypt(
        $string_to_encrypt,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );
}

// Decrypts the input string given in legible data.
// Returns the result.
function AES128_decrypt($string_input)
{
    $decryption_key = $_ENV['onlinenotes_master_key'];
    $ciphering = "AES-128-CTR";
    $string_to_decrypt = $string_input;

    $decryption_iv = '1234567891011121';
    $options = 0;

    return openssl_decrypt(
        $string_to_decrypt,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );
}

// Creates a hashed password. 
// Returns an array with the generated salt and
// password hashed and salted.
function create_hashed_and_salted_password($password)
{
    $salt = generateRandomString(100);
    $password_ingredients = $salt . $password;
    $password_hashed = sha512_hashing($password_ingredients);
    return array("password_hashed" => $password_hashed, "salt" => $salt);
}

// Generates and returns a random string. Length given my the user as parameter.
function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Hashes given input in SHA512 and returns the result.
function sha512_hashing($input)
{
    return hash("sha512", $input);
}

// Compares two hashed and salted passwords.
function sha512_compare($salt_input, $password_input, $database_password)
{
    $password_ingredients = $salt_input . $password_input;
    $password_salted_and_hashed = sha512_hashing($password_ingredients);
    return $password_salted_and_hashed == $database_password;
}
