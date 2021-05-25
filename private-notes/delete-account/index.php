<?php

require "../../memory.php";
require "../../app/tasks.php";
require "../../app/database/read.php";
require "../../app/database/create.php";
require "../../app/database/delete.php";
require "../../app/database/update.php";

if (isset($_COOKIE['sessionToken'])) {
    $user_info = bring_user_data_by_cookie_sessionToken();
    // Makes sure there is a record found
    if (isset($user_info)) {
        // Session exists and all correct.
    } else {
        delete_cookie_sessionToken();
        header("Location: ../login?error=notLoggedIn");
    }
} else {
    delete_cookie_sessionToken();
    header("Location: ../login?error=notLoggedIn");
}

?>
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
    <link rel="stylesheet" href="../../public/styles/style.css">
    <link rel="stylesheet" href="../../public/styles/white-background.css">
</head>

<body>

    <div class="header">
        <a href="/">
            <img class="header_image img-fluid" src="../../public/img/online-notes-logo-plus-letters-side.png" alt="Missing image!">
        </a>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../" tabindex="-1" aria-disabled="true">Public notes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        echo substr($user_info["user_username"], 0, 20)
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../">Private notes</a>
                        <a class="dropdown-item" href="./user-log-out.php">Log out</a>
                        <a class="dropdown-item" href="./change-password/">Change password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Options</a>
                    </div>
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
        <div class="h2">Your account will be permanently deleted if you continue.</div>
        <br>
        <div class="h6">
            Your username will be released and all associated notes
            will be deleted.
        </div>
        <div class="h6">
            Are you sure?
        </div>
        <div>
            To confirm this action please write the following code on the next text field and click "Delete my account" button.
        </div>
        <br>
        Deletion code:
        <br>
        <?php
        // Creates a deletion code so to delete an account needs to be confirmed by the user.
        $_SESSION["userDeletionCode"] = generate_accountDeletionCode();
        echo '<div id="userDeletionCode" class="alert alert-warning" role="alert">' . $_SESSION["userDeletionCode"] . '</div>';
        ?>
        <form action="../delete-user.php" method="POST">
            <div class="form-group">
                <input onkeyup="deletionCodeCheck()" name="input_userDeletionCode" id="deleteAccount_textField" class="form-control" placeholder="Deletion code" type="text">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Confirm</button>
            <br>
        </form>
        <div id="userDeletionCode_notCorrect" class="alert alert-danger" role="alert">
            The code is not correct.
        </div>
        <div id="userDeletionCode_Correct" class="alert alert-success" role="alert">
            The code is correct.
        </div>
        <br>
        <br>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Options</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="shadow p-3 mb-5 bg-white rounded alert alert-secondary">
                        <div class="h5">Close all sessions</div>
                        <hr>
                        All your sessions will be closed. This means that if you left your private notes session
                        (login) open onto another computer, it will automatically be closed. Note: this session
                        will be closed too.
                        <hr>
                        <a href="./close-all-sessions.php">Close all open sessions.</a>
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded alert alert-secondary">
                        <div class="h5">API Connection Token</div>
                        <hr>
                        <b>For developers.</b> Create a API Connection Token which can be used to insert, read, and delete your private notes from external software.
                        <hr>
                        <a href="./api-connection-token">API Connection Token.</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

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

    <script src="./script.js"></script>
</body>

</html>