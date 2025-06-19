<?php
function getProducts($id):array
{
    //$pdo is the connection to the database.
    global $pdo;
    /*
     * this will collect all the categories from the category table and makes objects from the category class.
     * check Category.php in the Classes folder.
     */
    $products = $pdo->query("SELECT * FROM product WHERE category_id=$id")->fetchAll(PDO::FETCH_CLASS, 'Product');
    //gives back all the category objects
    return $products;
}

function getSingleProduct($requestedId):array {
    //$pdo is the connection to the database.
    global $pdo;
    /*
     * this will collect all the categories from the category table and makes objects from the category class.
     * check Category.php in the Classes folder.
     */
    $query = $pdo->prepare('SELECT * FROM product WHERE id=:id limit 1');
    $query->bindParam("id", $requestedId);
    $query->execute();
    //gives back all the category objects
    return $query->fetchAll(PDO::FETCH_CLASS, 'Category');
}

function getProductDetails($id):array
{
    //$pdo is the connection to the database.
    global $pdo;
    /*
     * this will collect all the categories from the category table and makes objects from the category class.
     * check Category.php in the Classes folder.
     */
    $productDetails = $pdo->query("SELECT * FROM product WHERE id=$id")->fetchAll(PDO::FETCH_CLASS, 'Product');
    //gives back all the category objects
    return $productDetails;
}