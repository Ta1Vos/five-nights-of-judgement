<?php

function checkLogin($user):string
{
    global $pdo;

    $dbUser = $pdo->query("SELECT * FROM registered_user WHERE first_name=" . $user["first-name"] . " AND password=" . $user["password"])->fetchAll(PDO::FETCH_CLASS, 'User');

    if (count($dbUser) > 0) {
        $dbUser = $dbUser[0];

        if (!empty($dbUser->first_name) && !empty($dbUser->password)) {
            if ($user["first-name"] == $dbUser->first_name && $user["password"] == $dbUser->password) {
                $_SESSION["user"] = $dbUser;

                if (isMember()) {
                    return "login true";
                } else if (isAdmin()) {
                    return "admin login true";
                } else {
                    return "Something went wrong!";
                }
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

function makeRegistration($user):string
{
    global $pdo;

    $query = $pdo->query("INSERT INTO registered_user(first_name, last_name, email, password, role) VALUES(:first_name, :last_name, :email, :password, 'member')");
    $query->bindParam("first_name", $user["first_name"]);
    $query->bindParam("last_name", $user["last_name"]);
    $query->bindParam("email", $user["email"]);
    $query->bindParam("password", $user["password"]);

    if ($query->execute()) {
        checkLogin($user);
        return "User registered and logged in!";
    } else {
        return "Something went wrong!";
    }

    return "false";
}
