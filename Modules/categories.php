<?php
/*
 * In this file you will write all the code which uses the database.
 * This includes all the SQL statements and the form validation.
 */
function getCategories():array
{
    //$pdo is the connection to the database.
    global $pdo;
    /*
     * this will collect all the categories from the category table and makes objects from the category class.
     * check Category.php in the Classes folder.
     */
    $categories = $pdo->query('SELECT * FROM category')->fetchAll(PDO::FETCH_CLASS, 'Category');
    //gives back all the category objects
    return $categories;
}

function getCategoryName(int $id):string
{
    global $pdo;
    $categories = null;

    switch ($params[1]) {
        case "category":
            //Grabs the id of the category from the link and searches the category name
            $categories = $pdo->query('SELECT name FROM category WHERE id=$params[2]')->fetch(PDO::FETCH_CLASS, 'Category');
            break;

        case "product":
            //Grabs the id of the product from the link and searches the product. Then display the category_id to
            $categoryId = $pdo->query('SELECT category_id FROM product WHERE id=$params[2]')->fetch(PDO::FETCH_CLASS, 'Category');
            $categoryId = $categoryId->category_id;
            //Finds the category name from the fetched category id
            $categories = $pdo->query('SELECT name FROM category WHERE id=$categoryId')->fetch(PDO::FETCH_CLASS, 'Category');
            break;
    }

    return $categories;
}
