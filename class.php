<?php

class Comptes {

    public $id;
    public $username;
    public $email;
    public $type;
    public $password;

    public function __construct($newUsername = "admin1", $newEmail = "admin1@gmail.com", $newType = "admin", $newPassword = "admin", $newId = -1)
    {
        $this->id = $newId;
        $this->username = $newUsername;
        $this->email = $newEmail;
        $this->type = $newType;
        $this->password= $newPassword;
    }

    public function Initialize($array)
    {
        $this->id = $array['id'];
        $this->username= $array['username'];
        $this->email = $array['email'];
        $this->type = $array['type'];
        $this->password = $array['password'];
    }

    public function set_id($newId)
    {
        $this->id = $newId;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_username($newUsername)
    {
        $this->username = $newUsername;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function set_email($newEmail)
    {
        $this->email = $newEmail;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function set_type($newType)
    {
        $this->type = $newType;
    }

    public function get_type()
    {
        return $this->type;
    }

    public function set_password($newPassword)
    {
        $this->password = $newPassword;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function GetArgumentsForInsert()
    {
        return ' (username, email, type, password) ';
    }

    public function GetValuesForInsert()
    {
        return " ('". $this->get_username() ."', '". $this->get_email() ."', '". $this->get_type() ."','". $this->get_password() ."')";
    }

    public function GetArgumentsForUpdate()
    {
        $arguments = [0 => 'username',
                      1 => 'email',
                      2 => 'type',
                      3 => 'password'];

        return $arguments;
    }

    public function GetValuesForUpdate()
    {
        $values = [0 => $this->get_username(),
                      1 => $this->get_email(),
                      2 => $this->get_type(),
                      3 => $this->get_password()];

        return $values;
    }
}