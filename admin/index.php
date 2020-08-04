<?php require "../memory.php"; ?>
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
        <a href="./logout.php">Admin log out</a>
        <br>
        <br>
        <b>Notice:</b>
        <p>
            Delete buttons do not ask if you are sure to delete the record.
            <br>
            Records will be <b>automatically deleted if "delete" button is pressed.</b>
        </p>
        <?php
        if (isset($_SESSION['admin_logged_in'])) {
            if ($_SESSION['admin_logged_in']) {
                require "../app/database/read.php";
                $notes_array = return_all_notes_in_an_array();
                echo "<h1>Notes record</h1>";
                echo "<br>";
                if ($notes_array) {
                    $array_amount_of_public_and_private_notes =
                        calculate_amount_of_private_and_public_notes($notes_array);
                    echo "<h3>Amount of notes stored</h3>";
                    echo "Number of notes stored: " . count($notes_array);
                    echo "<br>";
                    echo "Number of public notes stored: ";
                    echo $array_amount_of_public_and_private_notes['public_notes_amount'];
                    echo "<br>";
                    echo "Number of private notes stored: ";
                    echo $array_amount_of_public_and_private_notes['private_notes_amount'];
                    echo "<br>";
                    echo "<br>";
                    echo "<h3>Notes content</h3>";
                    for ($i = 0; $i < count($notes_array); $i++) {
                        echo "<div class='note_content_box'>";
                        echo "Note ID: " . $notes_array[$i]['ID'];
                        echo "<br>";
                        echo "Owner ID: " . $notes_array[$i]['owner_id'];
                        echo "<br>";
                        echo "Title:<br>" . $notes_array[$i]['title'];
                        echo "<br>";
                        echo "Description:<br>" . nl2br($notes_array[$i]['description']);
                        echo "<br><br>";
                        echo "Archived: " . $notes_array[$i]['archived'];
                        echo "<br>";
                        echo "In Trash Can: " . $notes_array[$i]['in_trash_can'];
                        echo "<br>";
                        echo "<a href='./delete-note.php?note_id=" . $notes_array[$i]["ID"] . "'>Delete this note</a>";
                        echo "<br>";
                        echo "<br>";
                        echo "</div>";
                    }
                    echo "<br>";
                    echo "<h3>Options</h3>";
                    echo "<a href='./delete-all-public-notes.php'>Delete all public notes</a>";
                } else {
                    echo "No public or private notes stored";
                }
                echo "<br>";
                echo "<br>";
                echo "<h1>Accounts record</h1>";
                require "./render_accounts_list.php";
            } else {
                $url = "./authentication.php";
                header('Location: ' . $url);
            }
        } else {
            $_SESSION['admin_logged_in'] = false;
            $url = "./authentication.php";
            header('Location: ' . $url);
        }

        // Returns an array with the amount of public and private notes
        // inside of a given array of notes.
        function calculate_amount_of_private_and_public_notes($notes_array)
        {
            $public_notes_counter = 0;
            $private_notes_counter = 0;
            for ($i = 0; $i < count($notes_array); $i++) {
                $owner_id = $notes_array[$i]['owner_id'];
                if ($owner_id == 'public') {
                    $public_notes_counter++;
                } else {
                    $private_notes_counter++;
                }
            }
            return array(
                "public_notes_amount" => $public_notes_counter, "private_notes_amount" => $private_notes_counter
            );
        }
        ?>
    </div>
    <hr>
    <footer>
        Online Notes - Made with love from Costa Rica by VICE.
    </footer>
</body>

</html>
