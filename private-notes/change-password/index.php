<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <title>Document</title>

    <link rel="stylesheet" href="../resources/styles/style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../public/styles/style.css">
</head>



<body>
    <div class="header">
        <h5 class="site_title">Online notes - Alpha 1.2.0</h5>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Online Notes</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link " href="/">Public notes</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="/private-notes/">Private notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="/faq">FAQ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="custom_container">
        <h4>Change your password form</h4>
        <p>
            <b>
                Logged in as
                <?php
                require "../../memory.php";
                echo substr($_SESSION['user_username'], 0, 20)
                ?>
            </b>
        </p>
        <form action="./change-password-logic.php" method="POST">
            <label for="">Current password</label>
            <input type="text" name="current_password" id="" required>
            <br>
            <label for="">Type new password</label>
            <input type="password" name="new_password" id="" required>
            <br>
            <label for="">Confirm new password</label>
            <input type="password" name="new_password_confirm" id="" required>
            <br>
            <div class="button-submit">
                <button type="submit">Submit</button>
            </div>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET['error'] == "emptySpaces") {
                echo "<div class='change_password_error error'>";
                echo "You must fill all the empty spaces!";
                echo "</div>";
            } else if ($_GET['error'] == "passwordsDoNotMatch") {
                echo "<div class='change_password_error error'>";
                echo "Passwords typed do not match";
                echo "<br>";
                echo "</div>";
            } else if ($_GET['error'] == "currentPasswordIncorrect") {
                echo "<div class='change_password_error error'>";
                echo "Current password typed is not correct.";
                echo "<br>";
                echo "</div>";
            } else if ($_GET['error'] == "InternalDataBaseError error") {
                echo "<div class='change_password_error'>";
                echo "Internal server error. Contact administrator for more information.";
                echo "<br>";
                echo "</div>";
            }
        } else if (isset($_GET['success'])) {
            echo "<div class='change_password_success success'>";
            echo "Password successfully changed!";
            echo "<br>";
            echo "</div>";
        }
        ?>
        <a href="/private-notes/">Go back to private notes</a>
    </div>
    <hr>
    <footer>
        Online Notes - Made with love from Costa Rica by VICE.
    </footer>
</body>

</html>