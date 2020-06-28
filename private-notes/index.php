<?php

require "../app/memory.php";

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
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online notes</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="shortcut icon" type="image/ico" href="resources/img/favicon.ico">
    <link rel="stylesheet" href="../resources/styles/style.css">
    <script src="../resources/script/private-home-script.js"></script>
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
                    <a class="nav-link" href="/" tabindex="-1" aria-disabled="true">Public notes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User actions
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./user-log-out.php">Log out</a>
                        <a class="dropdown-item" href="/private/change-password/">Change password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="deleteUserAccount()">Delete my account</a>
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

    <div class="store_notes">
        Stored notes
    </div>
    <?php require '../logic/notes/render-private-notes.php'; ?>
    <hr>
    <div class="write_a_new_note">
        Write a new note
    </div>
    <div class="new_note_form">
        <form action="../logic/get/insert-private-note.php" method="GET">
            <label for="note_title">Note title:</label>
            <input placeholder="Note title here." type="text" name="note_title" id="note_title">
            <br>
            <label for="note_description">Note description:</label>
            <br>
            <textarea placeholder="Enter your note here. Come here again to see your note. Only those with this account credentials can create and delete notes.&#13;&#10;&#13;&#10;Do not store sensitive information.&#13;&#10;Read FAQ for more info." name="note_description" id="note_description" cols="90" rows="10" required></textarea>
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
    <hr>
    <footer>
        Online Notes - Made with love from Costa Rica by VICE.
    </footer>
</body>

</html>