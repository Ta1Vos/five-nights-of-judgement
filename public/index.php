<?php
/*
 * This file is the first file that will be run.
 * The code in this file will check on which page you are and includes all the files that are needed.
 */

//make sure you add all the modules.
require '../Modules/common.php';
require '../Modules/categories.php';
require "../Modules/products.php";
require "../Modules/frequently_visited.php";
require "../Modules/database_update.php";
require '../Modules/login.php';
require '../Modules/logout.php';

require "../Modules/edit-profile.php";
//includes the code to connect to the database
require '../Modules/database.php';
//loads the information of the navbar
require "../Modules/navbar_content.php";
require "../Modules/reviews.php";
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

$navbarCategoryContent = null;
loadNavbarContent();

/* $params[1] is the action (the page you are visiting).
 *$params[2] is parameter you give to the page.
 *the switch statement checks which page you want to go.
 */

//Fixes crucial bug with the navbar, in case illegal content is present as the 'id' for a category or a product.
if (($params[1] == "category" || $params[1] == "product") && $params[2] != intval($params[2])) {
    header("Location: /$params[2]");//Redirects to the page listed after category or product, as that usually breaks.
}

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
        $products = getProducts($params[2]);//Fetches the products
        $categoryName = getCategoryName($params[1], $params[2]);//Gets category name for the breadcrumb link

        //Breadcrumb link for visitors
        $breadcrumbLink = "<li class='breadcrumb-item'><a href='/category/$params[2]'>$categoryName</a></li>";

        include_once "../Templates/products.php";
        break;

    case 'product':
        updateVisits("product", $params[2]);//Updates visits by one
        $productDetails = getProductDetails($params[2]);//Fetches the product details
        $categoryName = getCategoryName($params[1], $params[2]);//Gets category name for the breadcrumb link
        $reviewMessages = loadReviews($params[2]);//Gets review messages to show all of the reviews

        $product = $productDetails[0];

        //Breadcrumb Link for visitors
        $breadcrumbLink = "<li class='breadcrumb-item'><a href='/category/$product->category_id'>$categoryName</a></li>";
        $breadcrumbLink .= "<li class='breadcrumb-item'><a href='/product/$product->id'>$product->name</a></li>";
        include_once "../Templates/product-detail.php";
        break;

    case 'login':
        $titleSuffix = ' | Log In';

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

        validateLogIn();
        include_once "../Templates/login.php";
        break;

    case 'logout':
        logout();
        $titleSuffix = ' | Log Out';
        header("Location: /home");
        break;

    case 'register':
        $titleSuffix = ' | Register';

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

        //Popular id is a special identifier for the popular pages, it makes it easy for the admin to reset the visits.
        $popularId = [null, 0];//Value for which row/column is created for the freq. visited.
        $frequentlyVisitedCategories = calculateFrequentlyVisited("category");
        $popularId = [null, 0];
        $frequentlyVisitedPages = calculateFrequentlyVisited("product");

        $frequentlyVisitedCategories = loadCardContents($frequentlyVisitedCategories, "category");
        $frequentlyVisitedPages = loadCardContents($frequentlyVisitedPages, "product");
        include_once "../Templates/home.php";
}







