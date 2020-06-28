<?php

require "../../../memory.php";

if (isset($_SESSION['user_logged_in'])) {
    if (!$_SESSION['user_logged_in']) {
        header("Location: /login?error=notLoggedIn");
    }
} else {
    header("Location: /login?error=notLoggedIn");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./change-password-logic.php" method="POST">
        <label for="">Current password</label>
        <input type="text" name="current_password" id="" required>
        <label for="">Type new password</label>
        <input type="password" name="new_password" id="" required>
        <label for="">Confirm new password</label>
        <input type="password" name="new_password_confirm" id="" required>
        <button type="submit">Submit</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET['error'] == "emptySpaces") {
            echo "<div class='change_password_error'>";
            echo "You must fill all the empty spaces!";
            echo "</div>";
        } else if ($_GET['error'] == "passwordsDoNotMatch") {
            echo "<div class='change_password_error'>";
            echo "Passwords typed do not match";
            echo "<br>";
            echo "</div>";
        } else if ($_GET['error'] == "currentPasswordIncorrect") {
            echo "<div class='change_password_error'>";
            echo "Current password typed is not correct.";
            echo "<br>";
            echo "</div>";
        } else if ($_GET['error'] == "InternalDataBaseError") {
            echo "<div class='change_password_error'>";
            echo "Internal server error. Contact administrator for more information.";
            echo "<br>";
            echo "</div>";
        }
    } else if (isset($_GET['success'])) {
        echo "<div class='change_password_success'>";
        echo "Password successfully changed!";
        echo "<br>";
        echo "</div>";
    }
    ?>
    <a href="/private/">Go back to private notes</a>
</body>

</html>