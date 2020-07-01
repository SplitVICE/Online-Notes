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
                    <a class="nav-link" href="#">FAQ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="custom_container">
        <br>
        <h3>Do you want to store your own private notes?</h3>
        <br>
        <h6>Make a free account and to store private notes.</h6>
        <p>
            For further information, visit FAQ page.
        </p>
        <form action="register-user.php" method="POST">
            <label for="">Username:</label>
            <input type="text" name="username_input" id="username_input_id" required>
            <br>
            <label for="">Password:</label>
            <input type="password" name="password_input" id="" required>
            <br>
            <label for="">Confirm password:</label>
            <input type="password" name="password_input_repeat" id="" required>
            <br>
            <div class="button-submit">
                <button type="submit">Submit</button>
            </div>
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
            } else if ($_GET['error'] == "passwordsDoNotMatch") {
                echo "<div class='loginError'>";
                echo "The passwords do not match. Try again.";
                echo "</div>";
            }
        }
        ?>
        <a href="../login/">Login</a>
        <br>
        <a href="/">Go back home</a>
    </div>
    <footer>
        Online Notes - Made with love from Costa Rica by VICE.
    </footer>
    <script src="script.js"></script>
</body>

</html>