<?php require "../memory.php"; ?>
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
    <script src="../public/script/global-script.js"></script>
    <link rel="stylesheet" href="../public/styles/style.css">
</head>

<body>

    <div class="header">
        <a href="./">
            <img class="header_image img-fluid" src="../public/img/online-notes-logo-plus-letters-side.png" alt="Missing image!">
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
                <li class="nav-item active">
                        <a class="nav-link" href="./private-notes/">Private notes<span class="sr-only">(current)</span></a>
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

    <script src="./public/script/public-notes-index.js"></script>
</body>

</html>