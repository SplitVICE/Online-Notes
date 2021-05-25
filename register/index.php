<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Config -->
    <meta charset="UTF-8">
    <title>Online notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="../public/img/favicon.ico">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- Scripts and styles -->
    <link rel="stylesheet" href="../public/styles/style.css">
    <link rel="stylesheet" href="../public/styles/white-background.css">
</head>

<body>

    <div class="header">
        <a href="../">
            <img class="header_image img-fluid" src="../public/img/online-notes-logo-plus-letters-side.png" alt="Missing image!">
        </a>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link " href="../">Public notes</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../login/">Login<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Register</a>
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

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-7">
                <br>
                <div class="title">
                    Register and start storing private notes.
                </div>
                <br>
                <form action="register-user.php" method="POST">
                    <div class="form-group">
                        <input placeholder="Username" class="form-control" type="text" name="username_input" id="username_input_id" required>
                    </div>
                    <div class="form-group">
                        <input placeholder="Password" class="form-control" type="password" name="password_input" id="" required>
                    </div>
                    <div class="form-group">
                        <input placeholder="Confirm password" class="form-control" type="password" name="password_input_repeat" id="" required>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                    <br>
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET['error'] == "emptyFields") {
                            echo "<div class='alert alert-danger'>";
                            echo "You must fill all the fields!";
                            echo "</div>";
                        } else if ($_GET['error'] == "usernameTaken") {
                            echo "<div class='alert alert-danger'>";
                            echo "The username given is already in use.";
                            echo "</div>";
                        } else if ($_GET['error'] == "passwordsDoNotMatch") {
                            echo "<div class='alert alert-danger'>";
                            echo "The passwords do not match. Try again.";
                            echo "</div>";
                        }
                    }
                    ?>
                </form>
                <div>
                    Already have an account?
                    <a href="../login/">Login</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <footer>
        <div class="container">
            <a target="_blank" href="https://github.com/splitvice/Online-Notes">
                <i class="fab fa-github-square fontawesome"></i>
            </a>
            <a target="_blank" href="http://split-vice.com/s/twitter">
                <i class="fab fa-twitter-square fontawesome"></i>
            </a>
            <a target="_blank" href="http://split-vice.com/technology/web-software/online-notes/">
                <i class="fas fa-laptop-code fontawesome"></i>
            </a>
            <br>
            <div class="footer_text">
                Online Notes - Made with <i class="fas fa-theater-masks"></i> from Costa Rica by VICE.
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>