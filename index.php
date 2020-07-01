<?php require __DIR__ . "/memory.php"; ?>
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
    <link rel="shortcut icon" type="image/ico" href="public/img/favicon.ico">
    <link rel="stylesheet" href="public/styles/style.css">
</head>

<body>

    <div class="header">
        <h5 class="site_title">Online notes - Alpha 4.0.0</h5>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Online Notes</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Public notes</a>
                </li>
                <?php
                if (!$_SESSION['user_logged_in']) {
                    echo
                        '
                        <li class="nav-item active">
                            <a class="nav-link" href="./login/">Login<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="./register/">Register<span class="sr-only">(current)</span></a>
                        </li>   
                        ';
                } else {
                    echo '<li class="nav-item active">
                        <a class="nav-link" href="./private-notes/">Private notes<span class="sr-only">(current)</span></a>
                    </li>';
                }

                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="./faq/">FAQ<span class="sr-only">(current)</span></a>
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
    <?php require 'app/notes/render-public-notes.php'; ?>
    <hr>

    <div class="write_a_new_note">
        Write a new note
    </div>
    <div class="new_note_form">
        <form action="app/notes/insert-public-note.php" method="GET">
            <label for="note_title">Note title:</label>
            <input placeholder="Note title here." type="text" name="note_title" id="note_title">
            <br>
            <label for="note_description">Note description:</label>
            <br>
            <textarea placeholder="Enter your note here. Come here again to see your note. You and anyone else can delete notes at any time.&#13;&#10;&#13;&#10;Do not store sensitive information.&#13;&#10;Read FAQ for more info." name="note_description" id="note_description" cols="90" rows="10" required></textarea>
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
    <hr>
    <footer>
        Online Notes - Made with love from Costa Rica by VICE.
    </footer>
    <script src="./public/script/public-notes-index.js"></script>
</body>

</html>