<?php
require "./memory.php";
require "./app/tasks.php";
require "./app/database/read.php";
require "./app/database/create.php";
require "./app/database/delete.php";
require "./app/database/update.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Config -->
    <meta charset="UTF-8">
    <title>Online notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href="public/img/favicon.ico">

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
    <script src="public/script/description-characters-counter.js"></script>
    <script src="public/script/sweetalert-functions.js"></script>
    <script src="public/script/copy-notes-info.js"></script>
    <link rel="stylesheet" href="public/styles/style.css">
</head>

<body>

    <div class="header">
        <a href="./">
            <img class="header_image img-fluid" src="./public/img/online-notes-logo-plus-letters-side.png" alt="Missing image!">
        </a>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Public notes</a>
                </li>
                <?php
                if (!isset($_COOKIE['sessionToken'])) {
                    echo '
                    <li class="nav-item active">
                        <a class="nav-link" href="./login/">Login<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./register/">Register<span class="sr-only">(current)</span></a>
                    </li>   
                    ';
                } else {
                    echo '
                    <li class="nav-item active">
                        <a class="nav-link" href="./private-notes/">Private notes<span class="sr-only">(current)</span></a>
                    </li>
                    ';
                }
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="./faq/">FAQ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/about">About<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="store_notes">
        Public notes
    </div>
    <div class="write_a_new_note_ahref">
        <a onclick="writeANewNote_openCollapse()" href="#write_a_new_note_id">Write a new note</a>
    </div>
    <?php require './app/notes/render-public-notes.php'; ?>
    <hr>

    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingTwo">
                <div class="mb-0">
                    <button onclick="scrollIntoView_btnSubmitNote()" id="collapse_button" class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
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
                        <form action="app/notes/insert-public-note.php" method="POST">
                            <div class="form-group">
                                <input placeholder="Note's title" type="text" name="note_title" id="note_title" class="form-control">
                                <small class="form-text text-muted">Note's title is optional</small>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" cols="90" rows="11" required onkeyup="characters_counter()" placeholder="Note's description.&#13;&#10;Come here again anytime to see your note.&#13;&#10;You and anyone else can delete notes at any time.&#13;&#10;&#13;&#10;Do not store sensitive information.&#13;&#10;&#13;&#10;Create a free account to store private notes.&#13;&#10;Read FAQ for more info." name="note_description" id="note_description"></textarea>
                                <small id="emailHelp" class="form-text text-muted">
                                    <div id="characters_left">
                                        Characters left:
                                        <spanclass="amount_of_characters">
                                            100000
                                            </span>
                                    </div>
                                </small>
                            </div>
                            <button id="btn_submitNote" class="btn btn-outline-primary btn-block" type="submit">Submit</button>
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
    <script src="./public/script/public-notes-index.js"></script>
    <script src="public/script/note_functions.js"></script>
</body>

</html>