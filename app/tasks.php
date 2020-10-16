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

// Returns an array with the amount of public and private notes
// inside of a given array of notes.
// Requires an array of notes.
function calculate_amount_of_private_and_public_notes($notes_array)
{
    $public_notes_counter = 0;
    $private_notes_counter = 0;
    for ($i = 0; $i < count($notes_array); $i++) {
        $owner_id = $notes_array[$i]['owner_id'];
        if ($owner_id == 'public') {
            $public_notes_counter++;
        } else {
            $private_notes_counter++;
        }
    }
    $returnArray = array(
        "public_notes_amount" => $public_notes_counter, "private_notes_amount" => $private_notes_counter
    );
    return $returnArray;
}

// Generates a random hash.
function generateSessionToken()
{
    return bin2hex(random_bytes(34)); 
}

function delete_cookie_sessionToken(){
    setcookie("sessionToken", "", time() - 3600, "/");
}

// Generates a random hash.
function generate_apiConnectionToken()
{
    return bin2hex(random_bytes(35)); 
}

function generate_accountDeletionCode(){
    return bin2hex(random_bytes(10)); 
}

// Returns the date.
function getCurrentDate(){
    date_default_timezone_set("America/New_York");
    return date("Y/m/d h:i:sa");
}
