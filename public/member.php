<?php
global $params;
//$params[2] is de action en $params[3] een getal die de action nodig heeft
//check if user has role member
if (!isMember() && !isAdmin()) {
    logout();
    header("location:/home");
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

    if (isset($params[2])) {
        switch ($params[2]) {
            case 'edit-profile':
                $titleSuffix = ' | Edit profile';

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
            case 'change-email':
                $titleSuffix = ' | Email reset';

                $user = $_SESSION["user"];
                $email = $user->email;

                $emailInput = null;
                $emailConfirmInput = null;
                $passwordInput = null;

                $emailError = null;
                $emailConfirmError = null;
                $passwordError = null;
                $mainErrorField = null;

                if (isset($_POST["submit-email-change"])) {
                    $emailInput = $_POST["new-email"];
                    $emailConfirmInput = $_POST["new-email-confirm"];
                    $passwordInput = $_POST["current-password"];

                    $incorrectInput = false;

                    if (empty($emailInput)) {
                        $emailError = "You must fill in an email!";
                        $incorrectInput = true;
                    } else if (strlen($email) > 255) {
                        $emailError = "An email cannot be longer than 255 characters!";
                        $incorrectInput = true;
                    } else if (!filter_input(INPUT_POST, "new-email", FILTER_VALIDATE_EMAIL)) {
                        $emailError = "Fill in a valid email! (example: user@server.com)";
                        $incorrectInput = true;
                    }

                    if ($emailConfirmInput != $emailInput) {
                        $emailConfirmError = "The confirmation email is not equal to the new email!";
                        $incorrectInput = true;
                    }

                    if (empty($passwordInput)) {
                        $passwordError = "You must fill in your password!";
                        $incorrectInput = true;
                    } else if ($passwordInput != $user->password) {
                        $passwordError = "The password is incorrect!";
                        $incorrectInput = true;
                    }

                    if (!$incorrectInput) {
                        $updateResult = updateUserEmail($user->id, $emailInput, $user->email);

                        if ($updateResult == "true") {
                            $mainErrorField = "Email has successfully been changed!";
                            unset($_SESSION["user"]);
                            $_SESSION["user"] = fetchALLUserInfo($user->id);
                            header("refresh:4; Location: /member/edit-profile");
                        } else if (!$updateResult) {
                            $mainErrorField = "Something went wrong!";
                        } else {
                            $mainErrorField = $updateResult;
                        }
                    }
                }

                if ($email == null) {
                    $email = "<div class='error-field'>No email has been set!</div>";
                }

                include_once "../Templates/change-email.php";
                break;
            case 'change-password':
                $titleSuffix = ' | Password reset';

                $user = $_SESSION["user"];

                $oldPasswordInput = null;
                $passwordInput = null;
                $passwordConfirmInput = null;

                $oldPasswordError = null;
                $passwordError = null;
                $passwordConfirmError = null;

                if (isset($_POST["submit-password-change"])) {
                    $oldPasswordInput = $_POST["old-password"];
                    $passwordInput = $_POST["new-password"];
                    $passwordConfirmInput = $_POST["new-password-confirm"];

                    $incorrectInput = false;

                    if (empty($passwordInput)) {
                        $passwordError = "You must fill in a password!";
                        $incorrectInput = true;
                    } else if (strlen($passwordInput) > 100) {
                        $passwordError = "A password cannot be longer than 100 characters!";
                        $incorrectInput = true;
                    }

                    if ($passwordConfirmInput != $passwordInput) {
                        $passwordConfirmError = "The confirmation password is not equal to the new password!";
                        $incorrectInput = true;
                    }

                    if (empty($oldPasswordInput)) {
                        $oldPasswordError = "You must fill in your password!";
                        $incorrectInput = true;
                    } else if ($oldPasswordInput != $user->password) {
                        $oldPasswordError = "The password is incorrect!";
                        $incorrectInput = true;
                    }

                    if (!$incorrectInput) {
                        $updateResult = updateUserPassword($user->id, $passwordInput, $user->password);

                        if ($updateResult == "true") {
                            $mainErrorField = "Password has successfully been changed!";
                            unset($_SESSION["user"]);
                            $_SESSION["user"] = fetchALLUserInfo($user->id);
                            header("Location: /member/edit-profile");
                        } else if (!$updateResult) {
                            $mainErrorField = "Something went wrong!";
                        } else {
                            $mainErrorField = $updateResult;
                        }
                    }
                }

                include_once "../Templates/change-password.php";
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

                //Breadcrumb Link for member
                $breadcrumbLink = "<li class='breadcrumb-item'><a href='/member/$params[3]'>$categoryName</a></li>";

                include_once "../Templates/products.php";
                break;
            case 'product':
                updateVisits("product", $params[3]);//Updates visits by one
                $productDetails = getProductDetails($params[3]);//Fetches the product details
                $categoryName = getCategoryName($params[2], $params[3]);//Gets category name for the breadcrumb link
                $reviewMessages = loadReviews($params[3]);//Gets review messages to show all the reviews

                if (!$reviewMessages)
                    $reviewMessages = [];

                $product = $productDetails[0];

                //Breadcrumb Link for member
                $breadcrumbLink = "<li class='breadcrumb-item'><a href='/member/category/$product->category_id'>$categoryName</a></li>";
                $breadcrumbLink .= "<li class='breadcrumb-item'><a href='/member/product/$product->id'>$product->name</a></li>";

                //REVIEWS
                $reviewPlacingForm = "<input type='submit' name='open-reviews' class='btn btn-light' value='&plus; Place review'>";
                $descriptionError = null;
                $ratingError = null;
                $notificationField = null;

                if (isset($_SESSION["review-message"])) {
                    $notificationField = "Your review has been added!";
                    unset($_SESSION["review-message"]);
                } else {
                    if (isset($_POST["submit-review"]) && isset($_POST["review-description"]) && isset($_POST["review-rating"])) {//VALIDATE AND POST REVIEW
                        $description = $_POST["review-description"];
                        $rating = $_POST["review-rating"];
                      
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
                
                editReviewRating();

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
    }
}