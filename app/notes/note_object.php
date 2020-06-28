<?php
// Note object. Not being used at the moment.
class Note
{
    // Variables.
    public $ID;
    public $owner_id;
    public $title;
    public $description;
    public $archived;
    public $in_trash_can;

    // Methods.
    function set_owner_id($owner_id)
    {
        $this->owner_id = $owner_id;
    }

    function get_owner_id()
    {
        return $this->owner_id;
    }

    function set_title($title)
    {
        $this->title = $title;
    }

    function get_title()
    {
        return $this->title;
    }

    function set_description($description)
    {
        $this->description = $description;
    }

    function get_description()
    {
        return $this->description;
    }

    function set_archived($archived)
    {
        $this->archived = $archived;
    }

    function get_archived()
    {
        return $this->archived;
    }

    function set_in_trash_can($in_trash_can)
    {
        $this->in_trash_can = $in_trash_can;
    }

    function get_in_trash_can()
    {
        return $this->in_trash_can;
    }
}
?>
