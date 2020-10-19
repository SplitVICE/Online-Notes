<?php

require "../../memory.php";
require "../../app/tasks.php";
require "../../app/database/read.php";
require "../../app/database/create.php";
require "../../app/database/delete.php";
require "./functions.php";

if (isset($_COOKIE['sessionToken'])) {
    $user_info = bring_user_data_by_cookie_sessionToken();
    // Makes sure there is a record found
    if (isset($user_info)) {
        // Session exists and all correct.
    } else {
        delete_cookie_sessionToken();
        header("Location: ../login?error=notLoggedIn");
    }
} else {
    delete_cookie_sessionToken();
    header("Location: ../login?error=notLoggedIn");
}

?>
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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Scripts and styles -->
    <script src="../../public/script/description-characters-counter.js"></script>
    <script src="../../public/script/sweetalert-functions.js"></script>
    <script src="../../public/script/copy-notes-info.js"></script>
    <link rel="stylesheet" href="../../public/styles/style.css">
    <link rel="stylesheet" href="../../public/styles/private-notes.css">
    <link rel="stylesheet" href="../../public/styles/white-background.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="header">
        <a href="/">
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
                    <a class="nav-link" href="../../" tabindex="-1" aria-disabled="true">Public notes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../" tabindex="-1" aria-disabled="true">Private notes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        echo substr($user_info["user_username"], 0, 20)
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./user-log-out.php">Log out</a>
                        <a class="dropdown-item" href="./change-password/">Change password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Options</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">FAQ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <br>
        <div class="h1">API Connection Token</div>
        <p>API Connection Tokens can be used to publish, read, and delete private notes of this account ownership from external software.</p>
        <p>This is an IT developers functionality. Read <a href="#">API</a> page to learn more about API Connection Tokens and how to use it.</p>
        <hr>
        <?php         
        $result =  bring_api_connection_token_by_user_cookie_info();
        if(isset($result["user_id"])){
            $publishPermissionContent = renderPublishCheckButton($result);
            $readPermissionContent = renderReadCheckButton($result);
            $deletePermissionContent = renderDeleteCheckButton($result);
            $APIConnectionTokenActivePermissions = renderAPIConnectionTokenActivePermissions($result);
            echo '
                <div class=tokenExists>
                    <p class="h5">This account currently has an active API Connection Token.</p>
                    <hr>
                    <button id="btn_toggleApiVisible" class="btn btn-primary" type="button" onClick="apiConnectionToken_toggleVisible()">Show API Connection Token</button>
                    <br>
                    <br>
                    <div id="apiConnectionTokenHidden" class="alert alert-primary token">
                    xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
                    </div>
                    <div id="apiConnectionToken" class="alert alert-primary token">
                        ' . $result["token"] . '
                    </div>
                    <br>
                    <br>
                    <hr>
                    <div class="h5">API Connection Token permissions</div>
                    <p>
                        Stablish what permissions you want to give to this API Connection Token.
                        <br>
                        ' . $APIConnectionTokenActivePermissions . '
                    </p>
                    <form method="POST" action="update-api-connection-token-permissions.php">
                        ' . $readPermissionContent . '    
                        ' . $publishPermissionContent . '   
                        ' . $deletePermissionContent . '
                        <input type="submit" value="Save changes" class="btn btn-primary">
                   </form>
                    <hr>
                    <div class="h5">Options</div>
                    <button class="btn btn-danger" type="button" onClick="delete_apiConnectionToken()">Delete API Connection Token</button>
                    <br>
                    <br>
                </div>
            ';
        }else{
            echo '
            <div class="tokenDoesNotExist">
                <p>This account does not have an active API Connection Token.</p>
                <p>
                    Create a new API Connection Token clicking <a href="./create-api-connection-token.php">here.</a>
                </p>
            </div>
            ';
        }
        
        ?>
    </div>
    <!-- Modals -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Options</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="shadow p-3 mb-5 bg-white rounded alert alert-secondary">
                        <a href="./close-all-sessions.php">
                            <button type="button" class="btn btn-primary">Close all sessions</button>
                        </a>
                        <hr>
                        All your sessions will be closed. This means that if you left your private notes session
                        (login) open onto another computer, it will automatically be closed. Note: this session
                        will be closed too.
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded alert alert-secondary">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteAccount">Delete my account</button>
                        <hr>
                        Delete you account and all associated notes. None of the info will be kept into our databases.
                    </div>
                    <div class="shadow p-3 mb-5 bg-white rounded alert alert-secondary">
                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="openConnectionTokenPage()">API connection token</button>
                        <hr>
                        <b>For developers.</b> Create a API connection token which can be used to insert and read your private notes from other software.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <div class="h1">Delete account</div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="h4">Your account will be permanently deleted if your procedure.</div>
                    <div class="h4">
                        Your username will be released and all associated notes
                        will be deleted.
                    </div>
                    <br>
                    <div class="h4">
                        Are you sure?
                    </div>
                    <br>
                    To confirm this action please write "Delete" on the next text field and click "Delete my account" button.
                    <input type="text" name="" id="deleteAccount_textField">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="deleteUserAccount()">Delete my account</button>
                </div>
            </div>
        </div>
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

    <script src="index.js"></script>
</body>

</html>
