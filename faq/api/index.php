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
    <link rel="stylesheet" href="../../public/styles/style.css">
    <link rel="stylesheet" href="../../public/styles/white-background.css">
</head>

<body>

    <div class="header">
        <a href="../../">
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
                    <a class="nav-link " href="../../">Public notes</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="../../private-notes/">Private notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="/faq">FAQ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <div>For developers</div>
        <div>API</div>
        <p>
            There are a total of two APIs able to be used.
        </p>
        <ul>
            <li>Insert public notes via URL.</li>
            <li>Insert private notes via URL.</li>
        </ul>
        <div>Insert private note via URL</div>
        <div>Usage</div>
        <p>
            To post a new public note use the following URL route:
        </p>
        <p>
            <b>
                <div class="route-example">
                    /api/insert-public-note/index.php?note-title=YourNoteTitle&ampnote-description=YourNoteDescription
                </div>
            </b>
        </p>
        <div>Variables</div>
        <p>
            note-title - This variable is optional. Holds the title of your new note.
        </p>
        <p>
            note-description - Holds the description of your new note.
        </p>
        <div>Insert public note via URL</div>
        <p>
            This URL API allows users to post a new note related to a registered user.
        </p>
        <p>
            NOTE: The user and password of the user must be written on the URL. Use by your own risk.
        </p>
        <div>Usage</div>
        <p>
            Use the following route:
        </p>
        <p>
            <b>
                <div class="route-example">
                    /api/insert-private-note/index.php?note-title=YourNoteTitle&ampnote-description=Your-Note-Description&ampusername=Your-User-Name&amppassword=YourPassword
                </div>
            </b>
        </p>
        <div>Variables</div>
        <p>
            note-title - This variable is optional. Holds the title of your new note.
        </p>
        <p>
            note-description - Holds the description of your new note.
        </p>
        <p>
            username - Your username must be typed in this field to grant access to the written account.
        </p>
        <p>
            password - Your password must be typed in this field to grant access to the written account by cheeking
            credentials.
        </p>

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
</body>

</html>