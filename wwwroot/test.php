<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    $data = array('a' => 'apple', 'b' => 'banana', 'c' => 'catnip');

    echo $json_string = json_encode($data, JSON_PRETTY_PRINT);

    ?>

</body>

</html>