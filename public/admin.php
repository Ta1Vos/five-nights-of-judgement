<?php
global $params;

//check if user has role admin
if (!isAdmin()) {
    logout();
    header("location:/home");
    die("no u");
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

    if (!isset($params[2])) {//Small fix so user does not get instantly logged out
        header("Location: /admin/home");
    }

    //Fixes crucial bug with the navbar, in case illegal content is present as the 'id' for a category or a product.
    if (($params[2] == "category" || $params[2] == "product" || $params[2] == "manage-review") && $params[3] != intval($params[3])) {
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

    //TO DO IN CURRENT BRANCH
    //
    //
    // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    //
    // * Select for all images in edit & create.
    // * Contact page
    // * Other members rate reviews (level of usefulness)

    if (isset($params[2])) {
        switch ($params[2]) {
            case 'products':
                updateVisits("category", $params[2]);
                $products = getProducts($params[2]);//Fetches the products
                $categoryName = getCategoryName($params[2], $params[3]);//Gets category name for the breadcrumb link
                include_once "../Templates/products.php";
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

                $createCard = addNewCard("category");

                include_once "../Templates/categories.php";
                break;

            case 'category':
                updateVisits("category", $params[3]);
                $products = getProducts($params[3]);//Fetches the products
                $categoryName = getCategoryName($params[2], $params[3]);//Gets category name for the breadcrumb link

                //Breadcrumb Link for admin
                $breadcrumbLink = "<li class='breadcrumb-item'><a href='/admin/category/$params[3]'>$categoryName</a></li>";

                $createCard = addNewCard("product");

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
            case 'manage-review':
                if (!isset($params[3]) || ($params[3] != intval($params[3]))) {
                    echo "Something went wrong";
                    header("Location: /admin/home");
                }

                $review = fetchSingleReview($params[3]);

                if (!$review)//If review has not been fetched
                    header("Location: /admin/home");

                loadManageReviewSubmit($review);

                $titleSuffix = ' | Manage reviews';

                include_once "../Templates/admin/manage-review.php";
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
                $titleSuffix = ' | Creating';

                $titleError = null;
                $descriptionError = null;
                $imageError = null;
                $categoryError = null;
                $mainErrorField = null;

                $titleInput = null;
                $descriptionInput = null;
                $imageInput = null;
                $categoryInput = null;

                validateCardCreation();

                if ($params[3] == "category") {
                    include_once "../Templates/admin/defaults/add-category.php";
                } else if ($params[3] == "product") {
                    include_once "../Templates/admin/defaults/add-product.php";
                } else {
                    header("Location: /home");
                }

                include "../Templates/defaults/footer.php";
                break;

            case 'delete':
                if (!isset($params[4]) && $params[4] == intval($params[4])) {
                    echo "Something went wrong";
                    header("Location: /home");
                }
                $titleSuffix = ' | Deleting';

                $deleteConfirm = checkForDeleteFinalConfirm();

                if ($params[3] == "category") {
                    $categories = getSingleCategory($params[4]);
                    include_once "../Templates/admin/defaults/delete-category.php";
                } else if ($params[3] == "product") {
                    $products = getSingleProduct($params[4]);
                    include_once "../Templates/admin/defaults/delete-product.php";
                } else {
                    header("Location: /home");
                }
                break;

            case 'logout':
                logout();
                header("Location: /home");
                break;

            case 'member-searching':
                $titleSuffix = ' | Member searching';
                require "../Modules/member-editing.php";

                //Search page
                $memberSearchBar = null;
                $memberList = null;
                $moderationActionInput = null;
                $moderationActionError = null;

                $userEmail = null;

                $deleteUserError = null;
                $deleteUser = null;

                $searchError = null;
                $selectError = null;

                if (isset($_POST["select-member"])) {//Go to member page of selected member in list
                    if (isset($_POST["selected-member"])) {
                        if (filter_input(INPUT_POST, 'selected-member', FILTER_VALIDATE_INT)) {//Check if selected member is a number
                            $selectedMember = $_POST["selected-member"];
                            header("Location: /admin/member-listing/$selectedMember");
                        }
                    }
                } else if (isset($_POST["submit-member-search"])) {//Submit a member search by first and/or last name
                    if (isset($_POST["search-member-fn"]) && isset($_POST["search-member-ln"])) {
                        $memberSearchFN = $_POST["search-member-fn"];
                        $memberSearchLN = $_POST["search-member-ln"];
                        $memberList = searchUserName($_POST["search-member-fn"], $_POST["search-member-ln"]);

                        if (count($memberList) <= 0) {
                            $searchError = "No member under this first name / last name has been found!";
                        }
                    }
                } else if (isset($_POST["submit-member-search_all"])) {//Display a list with all the members
                    $memberList = searchUserName();
                }

                include_once "../Templates/admin/member-searching.php";

                include "../Templates/defaults/footer.php";
                break;
            case 'member-listing':
                $titleSuffix = ' | Member searching';

                if ($params[3] != intval($params[3])) {//Kick user out if param is not a number
                    header("Location: /admin/member-searching");
                }

                require "../Modules/member-editing.php";

                $userEmail = null;
                $userDeleteButton = "<input type='submit' name='delete-user' value='Delete/ban user' class='fw-bold'>";

                $deleteUserError = null;
                $mainErrorField = null;

                $user = searchUserByID($params[3]);

                if (!isset($user->first_name) || !isset($user->last_name)) {//Extra failsafe in case something goes wrong
                    header("Location: /admin/member-searching");
                }

                if (isset($user->email)) {
                    if ($user->email != null) {
                        $userEmail = $user->email;
                    } else {
                        $userEmail = "<i>No email has been set for this user</i>";
                    }
                }

                if (isset($_POST["delete-user"])) {
                    if ($user->role != "admin") {
                        $userDeleteButton = "
                    <h5>Input check:</h5>
                    <small>(input first name and last name)</small><br>
                    <input type='text' name='confirm-check' class='fw-bold'><br><br>
                    <input type='submit' name='confirm-delete-user' value='Are you sure you want to Delete/ban this user?' class='fw-bold'>
                    <br>
                    ";
                    }
                } else if (isset($_POST["confirm-check"]) && isset($_POST["confirm-delete-user"])) {
                    $memberNameCheck = $_POST["confirm-check"];

                    if ($memberNameCheck == "$user->first_name $user->last_name") {//Extra safe confirmation to delete users
                        if ($user->role != "admin") {//Admins cannot be removed
                            if (removeUser($user->id)) {//Remove user
                                $deleteUserError = "User has been removed from the database!";
                                header("Location: /admin/member-searching");
                            } else {
                                $deleteUserError = "Something went wrong while attempting to remove the user. Please contact a developer.";
                            }
                        } else {
                            $deleteUserError = "Unable to remove this user! User is an administrator.";
                        }
                    } else {
                        $deleteUserError = "Input is invalid, it is not equal to '{first name} {last name}' of the user.";
                    }
                }

                if ($user->role == "admin") {//Last failsafe so administrators cannot get removed
                    $deleteUserError = "Unable to remove this user! User is an administrator.";
                    $userDeleteButton = "";
                }

                include_once "../Templates/admin/list-member.php";
                include "../Templates/defaults/footer.php";
                break;
            case
            'image-deleting':
                $titleSuffix = ' | Image Deleting';
                require "../Modules/image-editing.php";

                $selectedImageToDelete = null;
                $productImages = array();
                $categoryImages = array();

                $selectedDeleteProduct = null;
                $selectedDeleteCategory = null;

                $loadSelectedDelete = true;//Loads the selection tab

                if (isset($_POST["selected-delete-product"])) {
                    //Grabs input value out of inputs
                    $selectedDeleteProduct = $_POST["selected-delete-product"];
                    $selectedDeleteCategory = $_POST["selected-delete-category"];
                } else if (isset($_SESSION["delete-category-img-name"]) || isset($_SESSION["delete-product-img-name"])) {
                    //Grabs value out of session
                    if (isset($_SESSION["delete-category-img-name"])) {//Set the category
                        $selectedDeleteCategory = $_SESSION["delete-category-img-name"];
                    }

                    if (isset($_SESSION["delete-product-img-name"])) {//Set the product
                        $selectedDeleteProduct = $_SESSION["delete-product-img-name"];
                    }
                }

                $productsLink = "../public/img/products";
                $categoriesLink = "../public/img/categories";
                //Fetch all product images
                $productDirs = fetchFilesFromDirectory("$productsLink", false, true);

                //Fetches the images out of all category maps within the products map.
                foreach ($productDirs as $productDir) {
                    $images = fetchFilesFromDirectory("$productsLink/$productDir");
                    //Filters out bools, in case execution went wrong somewhere. Usually occurs with empty directories
                    if (is_array($images)) {
                        $productImages[$productDir] = $images;
                    }
                }

                //Fetch all category images
                $categoryImages = fetchFilesFromDirectory("$categoriesLink", true);

                //Ask for delete confirmation in case delete has been pressed
                $deleteConfirm = checkForDeleteFinalConfirm();

                //Code in case deletion is confirmed
                if (isset($deleteConfirm)) {
                    if ($deleteConfirm != "true") {
                        $loadSelectedDelete = false;//Prevents loading of the selection tab

                        $catDeletePath = null;
                        $productDeletePath = null;
                        //Fetch the delete category image path
                        if (isset($selectedDeleteCategory) && $selectedDeleteCategory != "non-select") {
                            $_SESSION["delete-category-img-name"] = $selectedDeleteCategory;
                            $catDeletePath = scanForFileName("../public/img/categories", $selectedDeleteCategory);
                            $catDeletePath = str_replace("../public", "", $catDeletePath);//Removes the public directory as it does not exist in browser
                        }
                        //Fetch the delete product image path
                        if (isset($selectedDeleteProduct) && $selectedDeleteProduct != "non-select") {
                            $_SESSION["delete-product-img-name"] = $selectedDeleteProduct;
                            $productDeletePath = scanForFileName("../public/img/products", $selectedDeleteProduct);
                            $productDeletePath = str_replace("../public", "", $productDeletePath);//Removes the public directory as it does not exist in browser
                        }
                        //Refresh POST and page if nothing has been selected.
                        if (!isset($catDeletePath) && !isset($productDeletePath)) {
                            $_POST = [];
                            header("refresh: 0;");
                        }
                    } else {//Final confirmation confirmed, execution starts
                        unset($_SESSION["delete-category-img-name"]);
                        unset($_SESSION["delete-product-img-name"]);
                        //Delete product
                        if (isset($selectedDeleteProduct)) {
                            if ($selectedDeleteProduct != "non-select") {
                                $filePath = scanForFileName("../public/img/products", $selectedDeleteProduct);
                                if (deleteImage($filePath)) {
                                    header("Location: home");
                                } else {
                                    echo "<h1>SOMETHING WENT WRONG WHEN DELETING THE IMAGE AT: $filePath</h1>";
                                }
                            }
                        }
                        //Delete category
                        if (isset($selectedDeleteCategory)) {
                            if ($selectedDeleteCategory != "non-select") {
                                $filePath = scanForFileName("../public/img/categories", $selectedDeleteCategory);
                                if (deleteImage($filePath)) {
                                    header("Location: home");
                                } else {
                                    echo "<h1>SOMETHING WENT WRONG WHEN DELETING THE IMAGE AT: $filePath</h1>";
                                }
                            }
                        }
                    }
                }

                include_once "../Templates/admin/image-deleting.php";

                include "../Templates/defaults/footer.php";
                break;

            case "image-adding":
                $titleSuffix = ' | Image Adding';
                require "../Modules/image-editing.php";

                $imgDirLinks = [];

                $imgDirLinks["categories"] = "../public/img/categories";
                $imgDirLinks["products"] = ["../public/img/products", fetchAllFilesFromDirectory("../public/img/products", true)];

                echo "<pre>";
                var_dump($imgDirLinks);
                echo "</pre>";

                if (isset($_POST["submit-file-upload"])) {//Submit for the image
                    $validateUpload = true;
                    $imageError = null;

                    if (!empty($_FILES["file-upload"]["name"])) {//Check if an image has been input
                        $uploadedFile = $_FILES["file-upload"];
                        $uploadedFileName = $uploadedFile["name"];
                        $selectedDir = $_POST["directory-to-add-to"];

                        if (!isset($selectedDir)) {
                            //Validate selected directory
                            $imageError = "Please select a directory!";
                        } else if ($selectedDir == "non-select") {
                            //Check if an actual directory has been picked
                            $imageError = "Please select a word in the directory list! (Not '-' or empty spaces) ";
                        } else if (!getimagesize($uploadedFile["tmp_name"])) {
                            //Makes sure the file is an image
                            $imageError = "You can only submit images!";
                        } else if ($uploadedFile["size"] > 1000000000) {
                            //Does not accept images above 1GB
                            $imageError = "Images have to be below the size of 1 GB";
                        } else {
                            if ($uploadedFile["error"] !== UPLOAD_ERR_OK) {
                                $imageError .= "<br>Something went wrong! Please refresh the page and try again!";
                            }
                            if (file_exists("$selectedDir/$uploadedFileName")) {//Check if file already exists
                                $imageError .= "<br>This file(name) already exists in this directory!";
                                $validateUpload = false;
                            }
                            //After validation, executes script
                            if ($validateUpload) {
                                $targetedDir = str_replace("../public/", "", $selectedDir);

                                //Moves file into directory
                                if (move_uploaded_file($uploadedFile["tmp_name"], "$targetedDir/$uploadedFileName")) {
                                    $imageError = "The file has been uploaded!";
                                    header("Location: /admin/home");
                                } else {
                                    $imageError = "Something went wrong! Please refresh the page and try again!";
                                }
                            }
                        }
                    } else {
                        $imageError = "No file has been selected!";
                    }
                }


                include_once "../Templates/admin/image-adding.php";

                include "../Templates/defaults/footer.php";
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
        header("location:/admin/home");
    }
}