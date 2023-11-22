<?php

function checkLogin($user):string
{
    global $pdo;

    $dbUser = $pdo->query("SELECT * FROM registered_user WHERE first_name=" . $user["first-name"] . " AND password=" . $user["password"])->fetchAll(PDO::FETCH_CLASS, 'User');

    if (count($dbUser) > 0) {
        $dbUser = $dbUser[0];

        if (!empty($dbUser->first_name) && !empty($dbUser->password)) {
            if ($user["first-name"] == $dbUser->first_name && $user["password"] == $dbUser->password) {
                return "login true";
            }
        } else {
            return "Something went wrong!";
        }
    }

    return "no account detected";
}

function isAdmin():bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
    {
        $user=$_SESSION['user'];
        if ($user->role == "admin")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    return false;
}

function isMember():bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
    {
        $user=$_SESSION['user'];
        if ($user->role === "member")
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    return false;
}

function isAlreadyRegistered($username):bool {
    global $pdo;

    return false;
}

function makeRegistration():string
{
    global $pdo;

    return "false";
}
