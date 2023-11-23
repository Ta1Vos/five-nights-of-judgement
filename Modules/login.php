<?php

function checkLogin($user): string
{
    try {
        global $pdo;

        $dbUser = $pdo->prepare("SELECT * FROM registered_user WHERE first_name = :first_name AND last_name = :last_name AND password = :password");
        $dbUser->bindParam("first_name", $user["first_name"]);
        $dbUser->bindParam("last_name", $user["last_name"]);
        $dbUser->bindParam("password", $user["password"]);
        $dbUser->execute();
        $dbUser = $dbUser->fetchAll(PDO::FETCH_CLASS, 'User');

        if (count($dbUser) > 0) {
            $dbUser = $dbUser[0];

            if (!empty($dbUser->first_name) && !empty($dbUser->last_name) && !empty($dbUser->password)) {
                if ($user["first_name"] == $dbUser->first_name && $user["last_name"] == $dbUser->last_name && $user["password"] == $dbUser->password) {
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
    } catch (PDOException $exception) {
        return "Something went wrong! Error code: $exception";
    }
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

//Code used in 2 places, for the shared inputs
function validateInputs($firstName, $lastName, $email, $password, $emailPost): array
{
    $wrongInput = false;
    $firstNameError = null;
    $lastNameError = null;
    $emailError = null;
    $passwordError = null;

    if (empty($firstName)) {
        $firstNameError = "*Please fill in this field";
        $wrongInput = true;
    } else if (strlen($firstName) > 255) {
        $firstNameError = "*Please pick a first name shorter than 255 characters!";
        $wrongInput = true;
    }

    if (empty($lastName)) {
        $lastNameError = "*Please fill in this field";
        $wrongInput = true;
    } else if (strlen($lastName) > 255) {
        $lastNameError = "*Please pick a first name shorter than 255 characters!";
        $wrongInput = true;
    }

    if (strlen($email) > 255) {
        $emailError = "*Please pick an email shorter than 255 characters!";
        $wrongInput = true;
    } else if (!empty($email)) {
        if (!filter_input(INPUT_POST, $emailPost, FILTER_VALIDATE_EMAIL)) {
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

    $result["wrong_input"] = $wrongInput;
    $result["first_name_error"] = $firstNameError;
    $result["last_name_error"] = $lastNameError;
    $result["email_error"] = $emailError;
    $result["password_error"] = $passwordError;

    return $result;
}

//Validate registration inputs
function validateRegistration()
{
    if (isset($_POST['reg-submit'])) {
        //Accessing inputs
        global $firstName;
        global $lastName;
        global $email;
        global $password;
        global $passwordConfirm;
        //Accessing error fields
        global $firstNameError;
        global $lastNameError;
        global $emailError;
        global $passwordError;
        global $passwordConfirmError;
        global $mainErrorField;
        //Filling the inputs back in
        $firstName = $_POST['reg-fname'];
        $lastName = $_POST['reg-lname'];
        $email = $_POST['reg-email'];
        $password = $_POST['reg-password'];
        $passwordConfirm = $_POST['reg-password-confirm'];

        $result = validateInputs($firstName, $lastName, $email, $password, "reg-email");
        $firstNameError = $result["first_name_error"];
        $lastNameError = $result["last_name_error"];
        $emailError = $result["email_error"];
        $passwordError = $result["password_error"];
        $wrongInput = $result["wrong_input"];

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
            $user["first_name"] = $firstName;
            $user["last_name"] = $lastName;
            $user["email"] = $email;
            $user["password"] = $password;

            $message = makeRegistration($user);
            //Check if the user has been registered, then log them in
            if ($message == "User registered and logged in!") {
                $mainErrorField = logIn($user);
            } else {
                $mainErrorField = $message;
            }
        } else {
            $mainErrorField = "Please fill in all fields and fill them in correctly!";
        }
    }

    return null;
}

//Validate log in inputs
function validateLogIn()
{
    if (isset($_POST['login-submit'])) {
        //Accessing inputs
        global $firstName;
        global $lastName;
        global $email;
        global $password;
        //Accessing error fields
        global $firstNameError;
        global $lastNameError;
        global $emailError;
        global $passwordError;
        global $mainErrorField;
        //Filling the inputs back in
        $firstName = $_POST['login-fname'];
        $lastName = $_POST['login-lname'];
        $email = $_POST['login-email'];
        $password = $_POST['login-password'];

        $result = validateInputs($firstName, $lastName, $email, $password, "login-email");
        $firstNameError = $result["first_name_error"];
        $lastNameError = $result["last_name_error"];
        $emailError = $result["email_error"];
        $passwordError = $result["password_error"];
        $wrongInput = $result["wrong_input"];

        if (!$wrongInput) {
            $user["first_name"] = $firstName;
            $user["last_name"] = $lastName;
            $user["email"] = $email;
            $user["password"] = $password;

            $mainErrorField = logIn($user);
        } else {
            $mainErrorField = "Please fill in all fields and fill them in correctly!";
        }
    }

    return null;
}

//Registers an user
function makeRegistration($user): string
{
    global $pdo;

    $login = checkLogin($user);

    if ($login != "no account detected") {
        if (str_contains($login, "Something went wrong")) {
            return $login;
        }

        return "The account under this name already exists!";
    }

    $query = $pdo->prepare("INSERT INTO registered_user(first_name, last_name, email, password, role) VALUES(:first_name, :last_name, :email, :password, 'member')");
    $query->bindParam("first_name", $user["first_name"]);
    $query->bindParam("last_name", $user["last_name"]);
    $query->bindParam("email", $user["email"]);
    $query->bindParam("password", $user["password"]);

    if ($query->execute()) {
        $login = checkLogin($user);

        if ($login != "no account detected") {
            return "User registered and logged in!";
        }

        return "Account detected";
    } else {
        return "Something went wrong!";
    }
}

//Log in the user
function logIn($user): string
{
    $message = checkLogin($user);
    //Check if message contains true, then log user in
    if (str_contains($message, "true")) {
        header("Location: index.php");
    } else {
        return $message;
    }

    return "";
}