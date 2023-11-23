<?php
/*
 * This file is the first file that will be run.
 * The code in this file will check on which page you are and includes all the files that are needed.
 */

//make sure you add all the modules.
require '../Modules/categories.php';
require "../Modules/products.php";
require "../Modules/frequently_visited.php";
require "../Modules/database_update.php";
require '../Modules/login.php';
require '../Modules/logout.php';
//includes the code to connect to the database
require '../Modules/database.php';
require '../Modules/common.php';
//loads the information of the navbar
require "../Modules/navbar_content.php";
global $navbarCategoryContent;

session_start();
//var_dump($_SESSION);
//var_dump($_POST);

/*
 * this will get the part of the URL from the first "/".
 * so if the URL is "healthone.localhost/category/1" than $request will be "/category/1".
 */
$request = $_SERVER['REQUEST_URI'];

/*
 * this separates the URL where there is a "/" and puts it in an array.
 * For example: if the $request is "/category/1" than $params wil be:
 *  [0] => ""
 *  [1] => "category"
 *  [2] => "1"
 */
$params = explode("/", $request);
print_r($request);
//this wil be the title of your page
$title = "FNOJ";

//this variable will add text to your title. you can use this on the different pages.
$titleSuffix = "";

//if you want to send a message to the user you can use this variable.
$message = "";

/*$params[1] is the action (the page you are visiting).
 *$params[2] is parameter you give to the page.
 *the switch statement checks which page you want to go.
 */
switch ($params[1]) {

    case 'categories':
        //adds " | Categories:" to the title
        $titleSuffix = ' | Categories';
        /*
         * calls the function getCategories from categories.php in the modules folder.
         * check categories.php for more information.
         */
        $categories = getCategories();
        //var_dump($categories);die;

        /*
         * includes the template categories.php from the templates folder.
         * check categories.php for more information.
         */
        include_once "../Templates/categories.php";
        break;

    case 'category':
        updateVisits("category", $params[2]);
        $products=getProducts($params[2]);//Fetches the products
        $categoryName = getCategoryName();//Gets category name for the breadcrumb link
        include_once "../Templates/products.php";
        break;

    case 'product':
        updateVisits("product", $params[2]);//Updates visits by one
        $productDetails=getProductDetails($params[2]);//Fetches the product details
        $categoryName = getCategoryName();//Gets category name for the breadcrumb link
        $reviewMessages = loadReviews($params[2]);//Gets review messages to show all of the reviews

        $product = $productDetails[0];
        include_once "../Templates/product-detail.php";
        break;

    case 'login':
        $titleSuffix = ' | Home';
        include_once "../Templates/home.php";
        break;

    case 'logout':
        $titleSuffix = ' | Home';
        include_once "../Templates/home.php";
        break;

    case 'register':
        $titleSuffix = ' | Register';
        $errorMessage = null;
        //Values
        $firstName = null;
        $lastName = null;
        $email = null;
        $password = null;
        $passwordConfirm = null;
        //Error fields
        $firstNameError = null;
        $lastNameError = null;
        $emailError = null;
        $passwordError = null;
        $passwordConfirmError = null;
        $mainErrorField = null;

        validateRegistration();
        include_once "../Templates/register.php";
        break;

    case 'contact':
        $titleSuffix = ' | Contact';
        include_once "../Templates/contact.php";
        break;

    case 'admin':
        include_once('admin.php');
        break;

    case 'member':
        include_once('member.php');
        break;

    default:
        $titleSuffix = ' | Home';

        $frequentlyVisitedCategories = calculateFrequentlyVisited("category");
        $frequentlyVisitedPages = calculateFrequentlyVisited("product");

        $frequentlyVisitedCategories = loadCardContents($frequentlyVisitedCategories, "category");
        $frequentlyVisitedPages = loadCardContents($frequentlyVisitedPages, "product");
        include_once "../Templates/home.php";
}







