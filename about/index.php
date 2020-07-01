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
        <div class="title">
            <p>
                Online Notes <span class="online_notes_version">Version x.x.x</span>
            </p>
        </div>
        <br>
        <h5>Author</h5>
        <div class="vice_image_class">
            <img id="vice_image" src="../public/img/just-vice.png" alt="Missing image">
        </div>
        <p>
            Online Notes created entirely by VICE.
        </p>
        <p>
            Visit the author's web page clicking here: <a target="_blank" href="https://justvice.github.io/">VICE's archive web page.</a>
        </p>
        <br>
        <h5>Credits</h5>
        <p>
            The following external PHP projects were used to create Online Notes:
        </p>
        <ul>
            <li>
                <a target="_blank" href="https://getcomposer.org/">Composer - Dependency Manager for PHP</a>
            </li>
            <li>
                <a target="_blank" href="https://github.com/vlucas/phpdotenv">PHP dotenv</a>
            </li>
        </ul>
        <br>
        <h5>About</h5>
        <p>
            Online Notes is a freeware build with PHP and MIT Licensed
        </p>
        <p>
            You can download this entire project at it's Github repository and run your own Online Notes downloading it here: <a target="_blank" href="https://www.github.com/JustVice/Online-Notes/">Online Notes repository</a>
        </p>
    </div>
    <hr>
    <footer>
        Online Notes - Made with love from Costa Rica by VICE.
    </footer>
</body>

</html>