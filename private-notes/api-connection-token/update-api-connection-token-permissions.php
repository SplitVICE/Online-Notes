<?php
require "../../memory.php";
require "../../app/tasks.php";
require "../../app/database/read.php";
require "../../app/database/update.php";

update_apiConnectionToken_permissions(
    isPublishPermissionChecked()
    , isReadPermissionChecked()
    , isDeletePermissionChecked());

header("Location: ./index.php");

function isPublishPermissionChecked(){
    if(isset($_POST["publishPermission"])) return True; else return "0";
}
function isReadPermissionChecked(){
    if(isset($_POST["readPermission"])) return True; else return "0";
}
function isDeletePermissionChecked(){
    if(isset($_POST["deletePermission"])) return True; else return "0";
}