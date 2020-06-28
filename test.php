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

    if(return_value() != null){
echo"not null";
    }else{
        echo"null";
    }

    echo __DIR__;

    ?>

</body>

</html>