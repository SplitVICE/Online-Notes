<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="../logic/post/login-user.php" method="POST">
        <label for="">Username</label>
        <input type="text" name="username_input" id="">
        <label for="">Password</label>
        <input type="password" name="password_input" id="">
        <button type="submit">Submit</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET['error'] == "emptyFields") {
            echo "<div class='loginError'>";
            echo "You must fill all the fields!";
            echo "</div>";
        } else if ($_GET['error'] == "badCredentials") {
            echo "<div class='loginError'>";
            echo "Username does not exist or password is incorrect.";
            echo "<br>";
            echo "<a href='../register/'>Register now</a>";
            echo "</div>";
        }
    }
    ?>
    <a href="/">Go back home</a>
</body>

</html>