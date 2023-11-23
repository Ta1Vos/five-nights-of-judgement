<?php

function checkLogin($user): string
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

function isAdmin(): bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if ($user->role == "admin") {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function isMember(): bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if ($user->role === "member") {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function validateRegistration()
{
    if (isset($_POST['reg-submit'])) {
        global $firstName;
        global $lastName;
        global $email;
        global $password;
        global $passwordConfirm;

        global $firstNameError;
        global $lastNameError;
        global $emailError;
        global $passwordError;
        global $passwordConfirmError;
        global $mainErrorField;

        $firstName = $_POST['reg-fname'];
        $lastName = $_POST['reg-lname'];
        $email = $_POST['reg-email'];
        $password = $_POST['reg-password'];
        $passwordConfirm = $_POST['reg-password-confirm'];

        $wrongInput = false;

        if (empty($firstName)) {
            $firstNameError = "*Please fill in this field";
            $wrongInput = true;
        } else if (strlen($firstName) > 255) {
            $firstNameError = "*Please pick a first name shorter than 255 characters!";
            $wrongInput = true;
        }

        if (strlen($lastName) > 255) {
            $lastNameError = "*Please pick a last name shorter than 255 characters!";
            $wrongInput = true;
        } else if (strlen($email) > 255) {
            $firstNameError = "*Please pick an email shorter than 255 characters!";
            $wrongInput = true;
        } else if (!empty($email)) {
            if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
                $emailError = "*Please fill in a correct email!";
                $wrongInput = true;
            }
        }

        if (empty($password)) {
            $passwordError = "*Please fill in this field";
            $wrongInput = true;
        } else if (strlen($password) > 100) {
            $passwordError = "*Please pick a password shorter than 100 characters!";
            $wrongInput = true;
        } else if (strlen($password) <= 8) {
            $passwordError = "*A password has to be longer than 8 characters!";
            $wrongInput = true;
        }

        if (empty($passwordConfirm)) {
            $passwordConfirmError = "*Please fill in this field";
            $wrongInput = true;
        } else if (strlen($passwordConfirm) > 100) {
            $passwordConfirmError = "*Please pick a password shorter than 100 characters!";
            $wrongInput = true;
        } else if (strlen($passwordConfirm) <= 8) {
            $passwordConfirmError = "*A password has to be longer than 8 characters!";
            $wrongInput = true;
        } else if ($passwordConfirm != $password) {
            $passwordConfirmError = "*Confirmation password is not equal to the password!";
            $wrongInput = true;
        }

        if (!$wrongInput) {
            //CODE FOR CORRECT REGISTER
//            makeRegistration();
        } else {
            $mainErrorField = "Please fill in all fields and fill them in correctly!";
            echo "AAAAAAAAA";
        }
    }
}

function makeRegistration($user): string
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
}