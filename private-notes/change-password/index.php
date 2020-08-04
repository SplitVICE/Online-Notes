<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Config -->
    <meta charset="UTF-8">
    <title>Online notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../../public/img/favicon.ico">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- Scripts and styles -->
    <script src="../../public/script/global-script.js"></script>
    <link rel="stylesheet" href="../../public/styles/style.css">
    <link rel="stylesheet" href="../../public/styles/white-background.css">
</head>



<body>

    <div class="header">
        <img class="header_image img-fluid" src="../../public/img/online-notes-logo-plus-letters-side.png" alt="Missing image!">
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Online Notes</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link " href="../../">Public notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="/faq">Private notes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="/">FAQ</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-7">
                <br>
                <div class="title">
                    <div>
                        Password change.
                    </div>
                    <div>
                        Logged in as:
                        <?php
                        require "../../memory.php";
                        echo substr($_SESSION['user_username'], 0, 20)
                        ?>
                    </div>
                </div>
                <br>
                <form action="./change-password-logic.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" placeholder="Current password" type="text" name="current_password" id="" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control" placeholder="New password" type="password" name="new_password" id="" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Confirm password" type="password" name="new_password_confirm" id="" required>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                </form>
                <br>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET['error'] == "emptySpaces") {
                        echo "<div class='alert alert-danger'>";
                        echo "You must fill all the empty spaces!";
                        echo "</div>";
                    } else if ($_GET['error'] == "passwordsDoNotMatch") {
                        echo "<div class='alert alert-danger'>";
                        echo "Confirmation password failed: passwords don't match.";
                        echo "<br>";
                        echo "</div>";
                    } else if ($_GET['error'] == "currentPasswordIncorrect") {
                        echo "<div class='alert alert-danger'>";
                        echo "Current password is not correct.";
                        echo "<br>";
                        echo "</div>";
                    } else if ($_GET['error'] == "InternalDataBaseError error") {
                        echo "<div class='alert alert-danger'>";
                        echo "Internal server error. Contact administrator for more information.";
                        echo "<br>";
                        echo "</div>";
                    }
                } else if (isset($_GET['success'])) {
                    echo "<div class='alert alert-success'>";
                    echo "Password has been updated successfully.";
                    echo "<br>";
                    echo "</div>";
                }
                ?>
                <a href="../">Back to private notes.</a>
            </div>
        </div>
    </div>
    <hr>
    <footer>
        <div class="container">
            <a target="_blank" href="https://github.com/JustVice/Online-Notes">
                <i class="fab fa-github-square fontawesome"></i>
            </a>
            <a target="_blank" href="https://twitter.com/_JustVice_">
                <i class="fab fa-twitter-square fontawesome"></i>
            </a>
            <a target="_blank" href="https://justvice.github.io/technology/web-software/online-notes/">
                <i class="fas fa-laptop-code fontawesome"></i>
            </a>
            <br>
            <div class="footer_text">
                Online Notes - Made with <i class="fas fa-theater-masks"></i> from Costa Rica by VICE.
            </div>
        </div>
    </footer>
</body>

</html>
