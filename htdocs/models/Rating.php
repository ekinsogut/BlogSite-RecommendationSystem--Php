<?php

class Rating{

    public $score;

    function __construct($score) {
        $this->score = $score;

    }

    function get_score() {
        return $this->score;
    }

}

?>