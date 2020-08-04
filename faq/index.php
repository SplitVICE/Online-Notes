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
    <link rel="stylesheet" href="../public/styles/style.css">
    <link rel="stylesheet" href="../public/styles/white-background.css">
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
                    <a class="nav-link " href="../">Public notes</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="../private-notes/">Private notes</a>
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
        <div class="title_big">FAQ</div>
        <div class="subtitle">Purpose of this site</div>
        <p>
            Online Notes was made to share information between different devices or to store information to look it back later.
        </p>
        <hr>

        <div class="subtitle">Security of the site</div>
        <div class="text-secondary">Are the public notes encrypted?</div>
        <ul>
            <li>
                No. The <i>public</i> notes are stored as plain text. At the end, they are visible for everyone who visit the page.
            </li>
        </ul>
        <div class="text-secondary">Are the private notes encrypted?</div>
        <ul>
            <li>
                Yes. The notes stored as <i>private</i> notes are stored encrypted to ensure only those access to the account can read them.
            </li>
        </ul>
        <div class="text-secondary">Are user's accounts credentials securely stored?</div>
        <ul>
            <li>
                Yes, your password is securely stored following the current security standards used nowadays. Even administrators cannot know your password.
            </li>
        </ul>
        <hr>

        <div class="subtitle">Rules</div>
        <ul>
            <li>
                Do not store any illegal content on the site.
            </li>
            <li>
                Do not upload any sensitive content such as passwords, credentials, or URLs to private data.
            </li>
            <li>
                The information you store runs by your own responsibility.
            </li>
            <li>
                Administrators who run this page will not take any responsibility about any damage you or others could suffer due the content posted.
            </li>
        </ul>
        <hr>

        <div class="subtitle">Reserved rights</div>
        <ul>
            <li>
                We reserve the right to wipe database information at any given moment. This applies to public notes, private notes, and accounts.
            </li>
            <li>
                As owners of the site and database, we reserve the right to review your private notes without prior notification.
            </li>
        </ul>
        <hr>

        <div class="subtitle">
            API
        </div>
        <p>
            For developers and those who want to use the web application more deeply, visit the API page <a href="./api/">here.</a>
        </p>
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
</body>

</html>