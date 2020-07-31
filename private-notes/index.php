<?php

require "../memory.php";

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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Scripts and styles -->
    <script src="../public/script/global-script.js"></script>
    <link rel="stylesheet" href="../public/styles/style.css">
</head>

<body>

    <div class="header">
        <img class="header_image" src="/public/img/online-notes-logo-plus-letters-side.png" alt="Missing image!">
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                        <?php
                        echo substr($_SESSION['user_username'], 0, 20)
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./user-log-out.php">Log out</a>
                        <a class="dropdown-item" href="/private-notes/change-password/">Change password</a>
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
    <div class="write_a_new_note_ahref">
        <a href="#write_a_new_note_id">Write a new note</a>
    </div>
    <?php require '../app/notes/render-private-notes.php'; ?>
    <hr>
    
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingTwo">
                <div class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="write_a_new_note" id="write_a_new_note_id">
                            Write a new note
                        </div>
                        <small class="form-text text-muted center">Click here to write a new note</small>
                    </button>
                </div>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="container">
                        <form action="../app/notes/insert-private-note.php" method="GET">

                            <div class="form-group">
                                <input placeholder="Note's title" type="text" name="note_title" id="note_title" class="form-control">
                                <small class="form-text text-muted">Note's title is optional</small>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" required onkeyup="characters_counter()" name="note_description" id="note_description" cols="90" rows="11" placeholder="Note's description.&#13;&#10;Come here again anytime to see your note.&#13;&#10;You and anyone else can delete notes at any time.&#13;&#10;&#13;&#10;Do not store sensitive information.&#13;&#10;&#13;&#10;Create a free account to store private notes.&#13;&#10;Read FAQ for more info." required></textarea>
                                <small id="emailHelp" class="form-text text-muted">
                                    <div id="characters_left">
                                        Characters left:
                                        <spanclass="amount_of_characters">
                                            1980
                                            </span>
                                    </div>
                                </small>
                            </div>

                            <button class="btn btn-outline-primary btn-block" type="submit">Submit</button>
                        </form>
                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
    <script src="../public/script/private-notes-index.js"></script>
</body>

</html>