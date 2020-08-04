<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>

    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../resources/styles/style.css">
</head>

<body>

    <body>
        <div class="header">
            <h5 class="">Online notes - Alpha 1.2.0</h5>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- <a class="navbar-brand" href="#">Online Notes</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item active">
                        <a class="nav-link " href="/">Public notes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link " href="/private/">Private notes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/faq">FAQ<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="custom_container">

            <div class="title_content">
                API usage
            </div>
            
            <p>
                There are a total of two APIs able to use.
            </p>
            <ul>
                <li>Insert public notes via URL.</li>
                <li>Insert private notes via URL.</li>
            </ul>
            <h4>Insert public note via URL</h4>
            <h6>Usage</h6>
            <p>
                To post a new public note use the following URL route:
            </p>
            <p>
                <b>
                    /api/insert-public-note/index.php?note-title=YourNoteTitle&ampnote-description=YourNoteDescription
                </b>
            </p>
            <h6>Variables</h6>
            <p>
                note-title - This variable is optional. Holds the title of your new note.
            </p>
            <p>
                note-description - Holds the description of your new note.
            </p>
            <hr>
            <h4>Insert private note via URL</h4>
            <p>
                This URL API allows users to post a new note related to a registered user.
            </p>
            <p>
                NOTE: The user and password of the user must be written on the URL. Use by your own risk.
            </p>
            <h6>Usage</h6>
            <p>
                Use the following route:
            </p>
            <p>
                <b>
                    /api/insert-private-note/index.php?note-title=YourNoteTitle&ampnote-description=YourNoteDescription&ampusername=YourUserName&amppassword=YourPassword
                </b>
            </p>
            <h6>Variables</h6>
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
            Online Notes - Made with love from Costa Rica by VICE.
        </footer>
    </body>
</body>

</html>