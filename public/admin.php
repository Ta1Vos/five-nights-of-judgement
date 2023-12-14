<?php
global $params;

//check if user has role admin
if (!isAdmin()) {
    logout();
    header("location:/home");
} else {
    require '../Modules/admin.php';
    require '../Modules/edit-cards.php';

    echo "<br>";
    var_dump($params);
    echo "<br>";

    /*$params[1] is the admin role in case its being used.
     * $params[2] is the action (the page you are visiting).
     *$params[3] is parameter you give to the page.
     *the switch statement checks which page you want to go.
     */

    //Fixes crucial bug with the navbar, in case illegal content is present as the 'id' for a category or a product.
    if (($params[2] == "category" || $params[2] == "product") && $params[3] != intval($params[3])) {
        if ($params[3] != "edit") {//Debugger works differently for edit page, which still needs 2 params
            echo "<br><br>/$params[1]/$params[3]<br>";
            header("Location: /$params[1]/$params[3]");//Redirects to the page listed after category or product, as that usually breaks.
        } else {
            echo "<br><br>/$params[1]/$params[3]/$params[4]<br>";
            header("Location: /$params[1]/$params[3]/$params[4]");//Redirects to the page listed after category or product, as that usually breaks.
        }
    } else if (($params[2] == "edit" || $params[2] == "delete") && $params[4] != intval($params[4])) {
        header("Location: /$params[1]/$params[3]/$params[4]");//Redirects to the page listed after edit, as that usually breaks.
    }

    if (isset($params[2])) {
        switch ($params[2]) {
            case 'products':
                updateVisits("category", $params[2]);
                $products = getProducts($params[2]);//Fetches the products
                $categoryName = getCategoryName($params[2], $params[3]);//Gets category name for the breadcrumb link
                include_once "../Templates/products.php";
                break;
                break;

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
                updateVisits("category", $params[3]);
                $products = getProducts($params[3]);//Fetches the products
                $categoryName = getCategoryName($params[2], $params[3]);//Gets category name for the breadcrumb link

                //Breadcrumb Link for admin
                $breadcrumbLink = "<li class='breadcrumb-item'><a href='/admin/category/$params[3]'>$categoryName</a></li>";
                include_once "../Templates/products.php";
                break;
            case 'product':
                updateVisits("product", $params[3]);//Updates visits by one
                $productDetails = getProductDetails($params[3]);//Fetches the product details
                $categoryName = getCategoryName($params[2], $params[3]);//Gets category name for the breadcrumb link
                $reviewMessages = loadReviews($params[3]);//Gets review messages to show all the reviews

                $product = $productDetails[0];

                //Breadcrumb Link for admin
                $breadcrumbLink = "<li class='breadcrumb-item'><a href='/admin/category/$product->category_id'>$categoryName</a></li>";
                $breadcrumbLink .= "<li class='breadcrumb-item'><a href='/admin/product/$product->id'>$product->name</a></li>";

                include_once "../Templates/product-detail.php";
                break;

            case 'edit':
                if (!isset($params[4])) {
                    echo "Something went wrong";
                    header("Location: /home");
                }

                $titleSuffix = ' | Editing';
                $titleError = null;
                $descriptionError = null;
                $imageError = null;
                $categoryError = null;
                $mainErrorField = null;

                $titleInput = null;
                $descriptionInput = null;
                $imageInput = null;
                $categoryInput = null;

                include_once "../Templates/defaults/edit-cards.php"; //WARNING: THIS PART IS ONLY HALF OF THE PAGE

                $includeFile = loadRelatedEditContent();
                validateCardEdit();

                if (isset($includeFile)) {
                    include $includeFile;
                } else {
                    include "../Templates/defaults/footer.php";
                }
                break;

            case 'add':
                break;

            case 'delete':
                if (!isset($params[4]) && $params[4] == intval($params[4])) {
                    echo "Something went wrong";
                    header("Location: /home");
                }
                $titleSuffix = ' | Deleting';

                $categories = getSingleCategory($params[4]);

                $deleteConfirm = checkForDeleteFinalConfirm();

                include_once "../Templates/admin/defaults/delete-category.php";
                break;

            case 'logout':
                logout();
                header("Location: /home");
                break;

            default://Default is always home
                $titleSuffix = ' | Home';

                $popularId = [0, 0];//Value for which row/column is created for the freq. visited.
                $frequentlyVisitedCategories = calculateFrequentlyVisited("category");
                $popularId = [1, 0];
                $frequentlyVisitedPages = calculateFrequentlyVisited("product");

                $frequentlyVisitedCategories = loadCardContents($frequentlyVisitedCategories, "category");
                $frequentlyVisitedPages = loadCardContents($frequentlyVisitedPages, "product");
                include_once "../Templates/home.php";
                break;
        }
    } else {
        logout();
        header("location:/home");
    }
}