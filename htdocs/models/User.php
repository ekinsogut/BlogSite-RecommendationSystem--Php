<?php

class User{

    public $first_name;
    public $last_name;
    public $image;
    public $email;
    public $password;

    public function __construct() {

        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__userCon'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }

    }

    public function __userCon5($first_name, $last_name, $image, $email, $password) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->image = $image;
        $this->email = $email;
        $this->password = $password;

    }

    public function __userCon2($email, $password) {
        $this->email = $email;
        $this->password = $password;

    }

    function get_first_name() {
        return $this->first_name;
    }

    function get_last_name() {
        return $this->last_name;
    }

    function get_image() {
        return $this->image;
    }

    function get_email() {
        return $this->email;
    }

    function get_password() {
        return $this->password;
    }

}

?>