<?php

class User
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;

    public $role;

    public function __construct()
    {
        settype($this->id, 'integer');
    }
}