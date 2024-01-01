<?php
global $params;
//$params[2] is de action en $params[3] een getal die de action nodig heeft
//check if user has role member
if (!isMember() && !isAdmin()) {
    logout();
    header ("location:/home");
    die("no u");
} else {

    /*$params[1] is the member role in case its being used.
     * $params[2] is the action (the page you are visiting).
     *$params[3] is parameter you give to the page.
     *the switch statement checks which page you want to go.
     */

    //Fixes crucial bug with the navbar, in case illegal content is present as the 'id' for a category or a product.
    if (($params[2] == "category" || $params[2] == "product") && $params[3] != intval($params[3])) {
        header("Location: /$params[1]/$params[3]/$params[4]");//Redirects to the page listed after category or product, as that usually breaks.
    }

    switch ($params[2]) {

        case 'products':
            break;
        case 'profile':
            break;
        case 'editprofile':
            break;
        case 'changepassword':
            break;

        case 'categories':
            break;

        case 'category':
            updateVisits("category", $params[3]);
            $products=getProducts($params[3]);//Fetches the products
            $categoryName = getCategoryName($params[2], $params[3]);//Gets category name for the breadcrumb link

            //Breadcrumb Link for member
            $breadcrumbLink = "<li class='breadcrumb-item'><a href='/member/$params[3]'>$categoryName</a></li>";

            include_once "../Templates/products.php";
            break;
        case 'product':
            updateVisits("product", $params[3]);//Updates visits by one
            $productDetails=getProductDetails($params[3]);//Fetches the product details
            $categoryName = getCategoryName($params[2], $params[3]);//Gets category name for the breadcrumb link
            $reviewMessages = loadReviews($params[3]);//Gets review messages to show all the reviews

            $product = $productDetails[0];

            //Breadcrumb Link for member
            $breadcrumbLink = "<li class='breadcrumb-item'><a href='/member/category/$product->category_id'>$categoryName</a></li>";
            $breadcrumbLink .= "<li class='breadcrumb-item'><a href='/member/product/$product->id'>$product->name</a></li>";

            include_once "../Templates/product-detail.php";
            break;

        case 'review':
            break;

        case 'logout':
            logout();
            header("Location: /home");
            break;

        default://Default is always home
            break;
    }
}