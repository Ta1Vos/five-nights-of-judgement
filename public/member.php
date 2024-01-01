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
            case 'profile':
                break;
            case 'edit-profile':
                $titleSuffix = ' | Edit profile';
                var_dump($_SESSION);

                if (isset($_SESSION["user"]->id)) {
                    $user = $_SESSION["user"];
                    $email = "<span class='error-field'>No email has been set!</span>";
                    $password = null;
                    $passwordInputType = "password";

                    if ($user->email != null) {
                        $email = $user->email;
                    }

                    if (isset($_POST["toggle-password"])) {
                        $password = $user->password;
                        $passwordInputType = "text";
                        $_POST = [];
                        header("Refresh: 5");
                    } else {//Encrypts into random characters.
                        try {
                            $password = random_bytes(strlen($user->password));
                        } catch (Exception $exception) {
                            $password = "something went wrong";
                        }
                    }

                    include_once "../Templates/edit-profile.php";
                } else {
                    logout();
                    header("Location: /home");
                }


                break;
            case 'change-password':
                break;
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
        default://Default is always home
            break;
=======
                        if (validateReview($description, $rating)) {
                            if (isset($_SESSION["user"]->id)) {
                                $userId = $_SESSION["user"]->id;

                                if (createReview($description, $rating, $userId)) {
                                    $_POST = [];
                                    $_SESSION["review-message"] = true;
                                    header("Refresh: 0");
                                }

                            } else {
                                $notificationField = "Something went wrong! Please try logging out and back in.";
                            }
                        }
                    }

                    if (isset($_POST["open-reviews"]) || isset($_POST["submit-review"])) {//SHOW REVIEW PLACING FORM
                        $reviewPlacingForm = "<hr><br><h4 class='my-3'>Description</h4>";
                        $reviewPlacingForm .= "<div class='error-field'>$descriptionError</div>";
                        $reviewPlacingForm .= "<label class='row input-group'><div class='col-2'></div><textarea class='form-control col-8' name='review-description' placeholder='Your review goes here'></textarea><div class='col-2'></div></label>";
                        $reviewPlacingForm .= "<br><h4 class='my-3'>Rating</h4><small><i class='bi bi-star mx-1'></i>0 - 10<i class='bi bi-star-fill mx-1'></i></small><br>";
                        $reviewPlacingForm .= "<div class='error-field'>$ratingError</div>";
                        $reviewPlacingForm .= "<label><input type='number' name='review-rating' min='0' max='10' value='5' class='mt-2'></label><br>";
                        $reviewPlacingForm .= "<input type='submit' name='submit-review' class='btn btn-light mt-5' value='&plus; Place review'>";
                    }
                }

                include_once "../Templates/product-detail.php";
                break;

            case
            'logout':
                logout();
                header("Location: /home");
                break;

            default://Default is always home
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
    } else {
        header("Location: /member/home");
>>>>>>> Stashed changes
    }
}