<?php

function renderReadCheckButton($tokenParams){
    if($tokenParams["ReadPermission"] == 1){
        return '
        <input checked type="checkbox" id="readPermission" name="readPermission" value="readPermission">
        <label for="readPermission">Read notes</label><br>
        ';
    }else{
        return '
        <input type="checkbox" id="readPermission" name="readPermission" value="readPermission">
        <label for="readPermission">Read notes</label><br>
        ';
    }
}

function renderPublishCheckButton($tokenParams){
    if($tokenParams["PublishPermission"] == 1){
        return '
        <input checked type="checkbox" id="publishPermission" name="publishPermission" value="publishPermission">
        <label for="publishPermission">Publish notes</label><br>
        ';
    }else{
        return '
        <input type="checkbox" id="publishPermission" name="publishPermission" value="publishPermission checked">
        <label for="publishPermission">Publish notes</label><br>
        ';
    }
}

function renderDeleteCheckButton($tokenParams){
    if($tokenParams["DeletePermission"] == 1){
        return '
        <input checked type="checkbox" id="deletePermission" name="deletePermission" value="deletePermission">
        <label for="deletePermission">Delete notes</label><br>
        ';
    }else{
        return '
        <input type="checkbox" id="deletePermission" name="deletePermission" value="deletePermission">
        <label for="deletePermission">Delete notes</label><br>
        ';
    }
}
