<?php
/**
 * Returns the second params of the link to make links in html/navbar work.
 * @return string returns the string for the member, admin or regular user.
 */
function loadLinkContent():string {
    global $params;
    if (isMember() && $params[1] == "member") {
        return "/member/";//Returns member link
    } else if (isAdmin() && $params[1] == "admin") {
        return "/admin/";//Returns admin link
    }

    return "/";//Returns regular link
}

/**
 * Returns the possible additional params of the link to make links for include with the Templates and user levels (admin/member).
 * @return string returns the string for the member, admin or regular user.
 */
function loadCorrectIncludeFormat($defaultLink):string {
    if (isMember()) {
        return "member/" . $defaultLink;//Returns member link
    } else if (isAdmin()) {
        return "admin/" . $defaultLink;//Returns admin link
    }

    return "" . $defaultLink;//Returns nothing except for given link, as nothing has to be changed
}
function getTitle() {
    global $title, $titleSuffix;
    return $title . $titleSuffix;
}

/**
 * Fetch a table from $pdo (database) variable.
 * @param string $dbTableName The name of the table you wish to fetch the columns from
 * @return array|false Returns false is given table does not exist. Returns an empty array if table is empty, otherwise returns an array with every column.
 */
function fetchTable(string $dbTableName):array|false {
    try {
        global $pdo;
        //Validate + Sanitize table name to prevent SQL injection.
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $dbTableName)) {
            die("Invalid table name. Nice try if you tried to inject SQL.");
        }

        $query = $pdo->prepare("SELECT * FROM $dbTableName");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception){
        echo "<br><small>Something went wrong upon fetching a table.</small><br>";
        return false;
    }
}

/**
 * Compares the keys of an Object and an Array to see if the Array contains the keys of the Object.
 * @param object $object the object you want to compare the array with
 * @param array $content the array you want to compare the object with
 * @return array|false returns false if the array doesn't contain all keys. Returns an array with the legitimate content if the keys are equal to the Object.
 */
function validateObjectWithArray(object $object, array $content):array|false {
    $contentValid = true;
    $classProperties = get_object_vars($object);

    foreach ($classProperties as $key => $item) {//Grabs the required keys
        $keyIsEqual = false;

        foreach ($content as $contentKey => $contentItem) {//Checks if required keys exist in the given content
            if ($key === $contentKey) {//Key is found & break current loop
                $keyIsEqual = true;
                break;
            }
        }

        if (!$keyIsEqual) {//If key is not found, do not let content pass
            $contentValid = false;
        }
    }

    if ($contentValid) {//If all required keys are present, return true
        return $content;
    }

    return false;
}
