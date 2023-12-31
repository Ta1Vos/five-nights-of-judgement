<?php
/**
 * Search a member first & last name in the database.
 * @param string $firstName Optional | Request the first name. Leave empty to select any first name
 * @param string $lastName Optional | Request the last name. Leave empty to select any last name
 * @return array|string Returns array with the results | OR | Returns string with an error message
 */
function searchMemberName(string $firstName = "", string $lastName = ""):array|string {
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