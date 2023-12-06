<?php


function validateCategoryValues($content, $requiredContent) {

}

/**
 * @param array $content the array which you want to add to the Category table
 * @return bool is returned after function execution. True if everything went well, false if array has not been pushed to the database.
 */
function addToCategory(array $content):bool {
    $content["id"] = 0;
    $content["visits"] = 0;

    if (!validateObjectWithArray(new Category, $content)) {
        return false;
    }

    global $pdo;

    $query = $pdo->prepare("INSERT INTO category(name, picture, description, visits) VALUES(:name, :picture, :description, :visits)");
    $query->bindParam("name", $content["name"]);
    $query->bindParam("picture", $content["picture"]);
    $query->bindParam("description", $content["description"]);
    $query->bindParam("visits", $content["visits"]);

    if ($query->execute()) {
        return true;
    }

    return false;
}

/**
 * @param array $content the array which you want to add to the Product table
 * @return bool is returned after function execution. True if everything went well, false if array has not been pushed to the database.
 */
function addToProduct(array $content):bool {
    $content["id"] = 0;
    $content["visits"] = 0;

    if (!validateObjectWithArray(new Product, $content)) {
        return false;
    }

    global $pdo;

    $query = $pdo->prepare("INSERT INTO product(name, picture, description, visits, category_id) VALUES(:name, :picture, :description, :visits, :category_id)");
    $query->bindParam("name", $content["name"]);
    $query->bindParam("picture", $content["picture"]);
    $query->bindParam("description", $content["description"]);
    $query->bindParam("visits", $content["visits"]);
    $query->bindParam("category_id", $content["category_id"]);

    if ($query->execute()) {
        return true;
    }

    return false;
}

function validateCardEdit() {

}