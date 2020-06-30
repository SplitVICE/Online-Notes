<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    function return_value()
    {
        $variable = "";

        if (1 == 1) {
            $variable = "content";
            return $variable;
        } else {
            return null;
        }
    }

    if (return_value() != null) {
        echo "not null";
    } else {
        echo "null";
    }

    echo __DIR__;

    echo "<br>";
    // Store a string into the variable which 
    // need to be Encrypted 
    $simple_string = "Welcome to GeeksforGeeks\n";

    // Display the original string 
    echo "<br>";
    echo "Original String: " . $simple_string;

    // Store the cipher method 
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption 
    $encryption_iv = '1234567891011121';

    // Store the encryption key 
    $encryption_key = "GeeksforGeeks";

    // Use openssl_encrypt() function to encrypt the data 
    $encryption = openssl_encrypt(
        $simple_string,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    // Display the encrypted string 
    echo "<br>";
    echo "Encrypted String: " . $encryption . "\n";

    // Non-NULL Initialization Vector for decryption 
    $decryption_iv = '1234567891011121';

    // Store the decryption key 
    $decryption_key = "GeeksforGeeks";

    // Use openssl_decrypt() function to decrypt the data 
    $decryption = openssl_decrypt(
        $encryption,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    // Display the decrypted string 
    echo "<br>";
    echo "Decrypted String: " . $decryption;

    ?>

</body>

</html>