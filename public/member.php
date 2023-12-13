<?php
global $params;
//$params[2] is de action en $params[3] een getal die de action nodig heeft
//check if user has role admin
if (!isMember()) {
    logout();
    header ("location:/home");
} else {

    /*$params[1] is the member role in case its being used.
     * $params[2] is the action (the page you are visiting).
     *$params[3] is parameter you give to the page.
     *the switch statement checks which page you want to go.
     */

    //Fixes crucial bug with the navbar, in case illegal content is present as the 'id' for a category or a product.
    if (($params[2] == "category" || $params[2] == "product") && $params[3] != intval($params[3])) {
        header("Location: /$params[1]/$params[3]");//Redirects to the page listed after category or product, as that usually breaks.
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
            $categoryName = getCategoryName();//Gets category name for the breadcrumb link
            include_once "../Templates/products.php";
            break;
        case 'product':
            updateVisits("product", $params[3]);//Updates visits by one
            $productDetails=getProductDetails($params[3]);//Fetches the product details
            $categoryName = getCategoryName();//Gets category name for the breadcrumb link
            $reviewMessages = loadReviews($params[3]);//Gets review messages to show all the reviews

            $product = $productDetails[0];
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