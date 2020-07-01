<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <title>Document</title>

    <link rel="stylesheet" href="../public/styles/style.css">
    <link rel="stylesheet" href="style.css">
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
                    <a class="nav-link " href="/">Public notes</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="/private/">Private notes</a>
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
    <div class="custom_container">
        <h1>FAQ</h1>
        <h3>General</h3>
        <h5>Regarding content</h5>
        <p>
            <ul>
                <li>
                    Do not upload any source of illegal content.
                </li>
                <li>
                    Do not upload any sensitive content such as passwords, credentials, or URL to private data.
                </li>
            </ul>
            <p>
                Online Notes was made to share information between devices or to store information to look back later.
            </p>
            <p>
                Do not store any kind of information you wouldn't like others to see or associate with you. The information you store runs by your own responsability.
            </p>
        </p>
        <h5>Disclaimer</h5>
        <p>
            Administrators who run this page will not take any responsibility about any damage you or others could suffer due the content posted.
        </p>
        <h5>Reserved rights</h5>
        <p>
            We reserve the right to wipe database information at any given moment. This applies to public notes, private notes, and accounts.
        </p>
        <h3>Security</h3>
        <h5>Are the public notes encrypted?</h5>
        <p>
            No. The <i>public</i> notes are stored as plain text. At the end, they are visible for everyone.
        </p>
        <h5>Are the private notes encrypted?</h5>
        <p>
            Yes. The notes stored as <i>private</i> notes are stored encrypted to ensure only you can read them.
        </p>
        <h5>Are user's accounts credentials securely stored?</h5>
        <p>
            Yes, your password is securely stored in a way only you can know the password. Even the administrators cannot see or know your password.
        </p>
        <hr>
        <h3>For developers</h3>
        <h5>API</h5>
        <p>
            There are a total of two APIs able to be used.
        </p>
        <ul>
            <li>Insert public notes via URL.</li>
            <li>Insert private notes via URL.</li>
        </ul>
        <h5>Insert private note via URL</h5>
        <h6>Usage</h6>
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
        <h6>Variables</h6>
        <p>
            note-title - This variable is optional. Holds the title of your new note.
        </p>
        <p>
            note-description - Holds the description of your new note.
        </p>
        <h5>Insert public note via URL</h5>
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
                <div class="route-example">
                    /api/insert-private-note/index.php?note-title=YourNoteTitle&ampnote-description=Your-Note-Description&ampusername=Your-User-Name&amppassword=YourPassword
                </div>
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
    <hr>
    <footer>
        Online Notes - Made with love from Costa Rica by VICE.
    </footer>
</body>

</html>