<?php

/**
 * @param int $userID Required | The ID of the user
 * @param string $newEmail Required | The new email of the user
 * @param string $oldEmail Required | The old email of the user, used as an extra check.
 * @return false|string Returns false if something goes wrong.<br>Returns an error message if something goes wrong with the query.<br>Returns true in a string if everything goes well.
 */
function updateUserEmail(int $userID, string $newEmail, string $oldEmail):false|string
{
    try {
        global $pdo;
        //Failsafe in case something goes wrong, check if the email is equal to the old email
        $user = searchUserByID($userID);

        if (!is_object($user)) {
            return false;
        } else if ($user->email != $oldEmail) {
            return false;
        }

        $query = $pdo->prepare("UPDATE registered_user SET email=:email WHERE id = :id");
        $query->bindParam("id", $userID);
        $query->bindParam("email", $newEmail);

        if ($query->execute()) {
            return "true";
        }
    } catch (Exception $exception) {
        return "Something went wrong: $exception";
    }

    return false;
}

function fetchALLUserInfo(int $id) {
    try {
        global $pdo;
        $query = $pdo->prepare("SELECT id, first_name, last_name, email, password, role FROM registered_user WHERE id=:id limit 1");
        $query->bindParam('id', $id);

        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_CLASS, 'User');
            if (count($result) > 0) {
                return $result[0];
            }
        }
    } catch (PDOException $exception) {
        return "Something went wrong -><br> $exception<br>";
    }
    return "Something went wrong!";
}