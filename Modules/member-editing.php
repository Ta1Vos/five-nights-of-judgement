<?php
/**
 * Search a member first & last name in the database.
 * @param string $firstName Optional | Request the first name. Leave empty to select any first name
 * @param string $lastName Optional | Request the last name. Leave empty to select any last name
 * @return array|string Returns array with the results | OR | Returns string with an error message
 */
function searchUserName(string $firstName = "", string $lastName = ""):array|string {
    try {
        global $pdo;
        $firstName = '%' . $firstName . '%';
        $lastName = '%' . $lastName . '%';
        $query = $pdo->prepare("SELECT id, first_name, last_name FROM registered_user WHERE first_name LIKE :first_name AND last_name LIKE :last_name");
        $query->bindParam('first_name', $firstName);
        $query->bindParam('last_name', $lastName);

        if ($query->execute()) {
            return $query->fetchAll(PDO::FETCH_CLASS, 'User');
        }
    } catch (PDOException $exception) {
        return "Something went wrong -><br> $exception<br>";
    }
    return "Something went wrong!";
}

/**
 * Search a member by requesting their id.
 * @param int $id Required | The identifier of the user.
 * @return array|string Returns array with the results | OR | Returns string with an error message
 */
function searchUserByID(int $id):User|string {
    try {
        global $pdo;
        $query = $pdo->prepare("SELECT id, first_name, last_name, email, role FROM registered_user WHERE id=:id limit 1");
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

/**
 * Search a member by requesting their id.
 * @param int $id Required | The identifier of the user.
 * @return array|string Returns array with the results | OR | Returns string with an error message
 */
function removeUser(int $id):bool {
    try {
        global $pdo;
        $query = $pdo->prepare("DELETE FROM registered_user WHERE id=:id limit 1");
        $query->bindParam('id', $id);

        if ($query->execute()) {
            return true;
        }
    } catch (PDOException $exception) {
        echo "Something went wrong -> <br> $exception<br>";
    }
    return false;
}