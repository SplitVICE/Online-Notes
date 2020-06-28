<!doctype html>
<html lang="en">

<head>
    <!-- HTML5 coding protocol -->
    <meta charset="utf-8">

    <!-- Responsive tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap imports -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <!-- CSS and JS imports/templates -->
    <link rel="stylesheet" href="resources/styles/style_old.css">
    <!-- <link rel="stylesheet" href="/css/global.css">
    <script src="/js/global.js"></script> -->

    <!-- Browser icon -->
    

    <!-- Browser tab title -->
    <title>Public notes</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Public notes</h1>
                <h6>Store and delete public notes. Consult them anywhere</h6>
                <div id="accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne" class="">
                                    Click to show/hide notes list
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne"
                            style="">
                            <div class="card-body">

                            <!-- PHP include of the notes list. Includes a .php file with the list. -->
                            <?php
                            include "php-functions/view-registers-func.php";
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>
                    Save note
                </h3>

                <!-- For to insert data inside the database -->
                <!-- action = index that will be loaded when the button submit is clicked -->
                <!-- method = get -> the way to pass data to the .php (get method) -->
                <form action="php-functions/insert-register-func.php" method="get">

                    <!-- name = variable name that will be get from the .php file on the action to peform -->
                    <!-- placeholder = transparent text to add inside the textpanel -->
                    <!-- required = makes neccesary to complete the input to submit the form -->
                    <textarea rows="7" cols="60" name="info_to_save" required
                        placeholder="The text typed here will be stored inside the database.&#10;&#10;Some characters such as ' can trigger a error into the system.&#10;&#10;Made by V."></textarea>
                    <br>

                    <!-- Submit button. if value isn't written, the page will show the system language on button -->
                    <input class="btn btn-primary button" type="submit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>