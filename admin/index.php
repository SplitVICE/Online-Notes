<?php 
require "../memory.php";
require "../app/database/read.php";
require "../app/tasks.php";

if (isset($_SESSION['admin_logged_in'])) {
    if ($_SESSION['admin_logged_in']) {
    } else {
        $_SESSION['admin_logged_in'] = false;
        $url = "./authentication.php";
        header('Location: ' . $url);
    }
} else {
    $_SESSION['admin_logged_in'] = false;
    $url = "./authentication.php";
    header('Location: ' . $url);
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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- Scripts and styles -->
    <script src="../public/script/global-script.js"></script>
    <link rel="stylesheet" href="../public/styles/style.css">
    <link rel="stylesheet" href="../public/styles/white-background.css">
    <link rel="stylesheet" href="style.css">
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
                    <a class="nav-link" href="../">Public notes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../private-notes/">Private notes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./faq/">FAQ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/about">About<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <br>

    <div class="container border shadow-sm p-3 mb-5 bg-white rounded">

        <ul class="nav nav-pills nav-fill border shadow-sm p-3 bg-white rounded">
            <li class="nav-item">
                <a id="btnUsers" class="nav-link active" href="#/" onclick="usersDisplayToggle()">Users</a>
            </li>
            <li class="nav-item">
                <a id="btnPublicNotes" class="nav-link" href="#/" onclick="publicNotesDisplay()">Public notes</a>
            </li>
            <li class="nav-item">
                <a id="btnPrivateNotes" class="nav-link" href="#/" onclick="privateNotesDisplay()">Private notes</a>
            </li>
            <li class="nav-item">
                <a id="btnAppSettings" class="nav-link" href="#/" onclick="addSettingsDisplay()">App settings</a>
            </li>
            <li>
                <button type="button" class="btn btn-dark" onclick="adminLogout()">Admin logout</button>
            </li>
        </ul>

        <?php
        $array_notes = return_all_notes_in_an_array();
        // There are public or private notes.
        if ($array_notes) {

            // Calculates the amount of public and private notes in the array.
            $array_amount_of_public_and_private_notes =
                calculate_amount_of_private_and_public_notes($array_notes);

            // If there are public notes, render public notes table.
            if ($array_amount_of_public_and_private_notes["public_notes_amount"] > 0) {
                echo '
                <div id=publicNotesManagementPanel>';
                require "./render-public-notes.php";
                render_public_notes($array_notes);
                echo "</div>";
            } else { // No public notes. Render no public notes stored.
                echo '
            <div id=publicNotesManagementPanel>
                No public notes stored.
            </div>';
            }

            // If there are private notes, render private notes table.
            if ($array_amount_of_public_and_private_notes["private_notes_amount"] > 0) {
                echo '
                <div id=privateNotesManagementPanel>';
                require "./render-private-notes.php";
                render_private_notes($array_notes);
                echo "</div>";
            } else { // No private notes. Render no private notes stored.
                echo '
                <div id=privateNotesManagementPanel>
                    No private notes stored.
                </div>
            ';
            }
        } else { // No public nor private notes.
            echo '
            <div id=publicNotesManagementPanel>
                No public notes stored.
            </div>
            <div id=privateNotesManagementPanel>
                No private notes stored.
            </div>
        ';
        }
        echo '
        <div id="userManagementPanel">
            <div class="alert alert-secondary" role="alert">
                User management panel
            </div>
            ';
        // Renders users table. If no users, no users stored will be shown.
        require "./render_accounts_list.php";
        echo
            '</div>';
        ?>

        <div id="appSettingsManagementPanel">
        <br>
            <button type="button" class="btn btn-primary">Delete all sessions</button>
            <button type="button" class="btn btn-primary" onclick="deleteAllPublicNotes()">Delete all public notes</button>
            <button type="button" class="btn btn-primary">Delete all private notes</button>
            <button type="button" class="btn btn-primary">Delete all accounts</button>
            <button type="button" class="btn btn-primary">Wipe all data</button>
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
    <script src="./hideAndShow.js"></script>
    <script>
        usersDisplayToggle();
    </script>
</body>

</html>