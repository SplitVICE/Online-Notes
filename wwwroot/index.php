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
    <link rel="stylesheet" href="resources/styles/style.css">
</head>

<body>


    <div class="header">
        <h5 class="site_title">Online notes - Alpha 1.0.0</h5>
        <div class="author_webpage">
            <a target="_blank" href="https://justvice.github.io">Author webpage</a>
        </div>
    </div>

    <div class="store_notes">
        Stored notes
    </div>
    <?php require './logic/notes/render-public-notes.php'; ?>
    <hr>

    <div class="write_a_new_note">
        Write a new note
    </div>
    <div class="new_note_form">
        <form action="./logic/get/insert-public-note.php" method="GET">
            <label for="note_title">Note title:</label>
            <input placeholder="Note title here." type="text" name="note_title" id="note_title">
            <br>
            <label for="note_description">Note description:</label>
            <br>
            <textarea placeholder="Enter your note here. Come here again to see your note. You and anyone else can delete it at any time." 
            name="note_description" id="note_description" cols="90" rows="10" required></textarea>
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
    <!-- <hr>
    <div>
        Do you want private notes? Make an account.
        <br>
        <a href="./login/">Login</a>
        <a href="./register/">Register</a>
    </div> -->
    <footer>
        Online Notes - Made with love from Costa Rica by VICE.
    </footer>
    <script src="./resources/script/home-scripts.js"></script>
</body>

</html>