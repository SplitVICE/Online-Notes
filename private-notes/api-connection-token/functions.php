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

function renderAPIConnectionTokenActivePermissions($tokenParams){
    $msg = "<b>Active private notes permissions: ";
    if($tokenParams["DeletePermission"] == 0 && $tokenParams["PublishPermission"] == 0 && $tokenParams["ReadPermission"] == 0)
        $msg .= "none.";
    else{
        if($tokenParams["ReadPermission"] == 1)
        $msg .= "| Read ";
        if($tokenParams["PublishPermission"] == 1)
        $msg .= "| Publish ";
        if($tokenParams["DeletePermission"] == 1)
        $msg .= "| Delete ";
        $msg .= "|";
    }
    $msg .= "</b>";
    return $msg;
}
