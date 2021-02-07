<?php

class Article{

    public $name;
    public $image;
    public $body;
    public $active;

    function __construct($name, $image, $body, $active) {
        $this->name = $name;
        $this->image = $image;
        $this->body = $body;
        $this->active = $active;

    }

    function get_name() {
        return $this->name;
    }

    function get_image() {
        return $this->image;
    }

    function get_body() {
        return $this->body;
    }

    function get_active() {
        return $this->active;
    }

}

?>