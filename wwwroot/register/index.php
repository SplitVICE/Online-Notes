<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="../logic/post/register-user.php" method="POST">
        <label for="">Username</label>
        <input type="text" name="username_input" id="" required>
        <label for="">Password</label>
        <input type="password" name="password_input" id="" required>
        <button type="submit">Submit</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET['error'] == "emptyFields") {
            echo "<div class='loginError'>";
            echo "You must fill all the fields!";
            echo "</div>";
        } else if ($_GET['error'] == "usernameTaken") {
            echo "<div class='loginError'>";
            echo "Username already taken!";
            echo "</div>";
        }
    }
    ?>
    <a href="/">Go back home</a>
</body>

</html>