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