<?php
/*
 * In this file you will write all the code which uses the database.
 * This includes all the SQL statements and the form validation.
 */

//CATEGORY CARD LOADING CAN BE FOUND IN THE WEB PAGE / TEMPLATES FOLDER
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

function getCategoryName($actionParam, $parameterParam):string
{
    //Requests URI link and the function reads out the information, so it can find the category id
    $request = $_SERVER['REQUEST_URI'];
    $params = explode("/", $request);

    global $pdo;
    $categories = "";

    if (isset($actionParam)) {
        switch ($actionParam) {
            case "category":
                //Grabs the id of the category from the link and searches the category name
                $categories = $pdo->query("SELECT name FROM category WHERE id=$parameterParam")->fetchAll(PDO::FETCH_CLASS, 'Category');
                $categories = $categories[0]->name;
                break;

            case "product":
                //Grabs the id of the product from the link and searches the product. Then display the category_id to
                $categoryId = $pdo->query("SELECT category_id FROM product WHERE id=" . $parameterParam)->fetchAll(PDO::FETCH_CLASS, 'Category');
                $categoryId = $categoryId[0]->category_id;
                //Finds the category name from the fetched category id
                $categories = $pdo->query("SELECT name FROM category WHERE id=" . $categoryId)->fetchAll(PDO::FETCH_CLASS, 'Category');
                $categories = $categories[0]->name;
                break;
        }

        return $categories;
    }

    return "Error";
}
