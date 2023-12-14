<?php

function updateVisits($tableName, $id){
global $pdo;
//Selects the visits out of the database
    $query = $pdo->prepare("SELECT visits FROM $tableName WHERE id=$id");
    $query->execute();
    //Updates the visits by one
    $visits = $query->fetchAll(PDO::FETCH_CLASS, 'Category');
    $visits = $visits[0]->visits;
    $visits++;
    //Updates the visits in the database
    $query = $pdo->prepare("UPDATE $tableName SET visits=:visits WHERE id=:id");
    $query->bindParam("visits", $visits);
    $query->bindParam("id", $id);
    if (!$query->execute()){
        echo "Er is iets fout gegaan";
    }
}

function updateCategoryTable(string $id, string $name, string $picture, string $description):bool {
    try {
        global $pdo;

        $query = $pdo->prepare("UPDATE category SET name=:name, picture=:picture, description=:description WHERE id=:id");
        $query->bindParam("id", $id);
        $query->bindParam("name", $name);
        $query->bindParam("picture", $picture);
        $query->bindParam("description", $description);

        if ($query->execute()) {
            return true;
        }

        return false;
    } catch (PDOException $exception) {
        echo "<b>Something went wrong:</b><br><br>$exception<br><br>";
        return false;
    }
}

/**
 * Updates a product in the product table
 * @param string $id unique identifier of the product, required to find which product it is
 * @param string $name
 * @param string $picture the link of the picture linked to the product
 * @param string $description
 * @param int $categoryId the id of the category that is linked to the product
 * @return bool returns either true or false depending on the success of the execution, true being success.
 */
function updateProductTable(string $id, string $name, string $picture, string $description, int $categoryId):bool {
    try {
        global $pdo;

        $query = $pdo->prepare("UPDATE product SET name=:name, picture=:picture, description=:description, category_id=:category WHERE id=:id");
        $query->bindParam("id", $id);
        $query->bindParam("name", $name);
        $query->bindParam("picture", $picture);
        $query->bindParam("description", $description);
        $query->bindParam("category", $categoryId);

        if ($query->execute()) {
            return true;
        }

        return false;
    } catch (PDOException $exception) {
        echo "<b>Something went wrong:</b><br><br>$exception<br><br>";
        return false;
    }
}

/**
 * @param string $name
 * @param string $picture the link of the picture linked to the product
 * @param string $description
 * @param int $categoryId the id of the category that is linked to the product
 * @return bool returns either true or false depending on the success of the execution, true being success.
 */
function createProduct(string $name, string $picture, string $description, int $categoryId):bool {
    try {
        global $pdo;

        $query = $pdo->prepare("INSERT INTO product(name, picture, description, category_id) VALUES (:name, :picture, :description, :category_id)");
        $query->bindParam("name", $name);
        $query->bindParam("picture", $picture);
        $query->bindParam("description", $description);
        $query->bindParam("category_id", $categoryId);

        if ($query->execute()) {
            return true;
        }

        return false;
    } catch (PDOException $exception) {
        echo "<b>Something went wrong:</b><br><br>$exception<br><br>";
        return false;
    }

}