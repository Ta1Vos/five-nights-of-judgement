<?php

function validateProductInput(string $action):bool {
    //Make category values global, as they are only used inside the product tab
    global $categoryInput;
    global $categoryError;

    global $titleError;
    global $descriptionError;
    global $imageError;

    $titleInput = $_POST["$action-title"];
    $descriptionInput = $_POST["$action-desc"];
    $imageInput = $_POST["$action-img"];
    $categoryInput = $_POST["$action-category"];

    $result = validateSharedEditInputs($titleInput, $descriptionInput, $imageInput);
    $wrongInput = $result["wrong_input"];
    $titleError = $result["title_error"];
    $descriptionError = $result["desc_error"];
    $imageError = $result["img_error"];

    if (!filter_input(INPUT_POST, "$action-category", FILTER_VALIDATE_INT)) {
        $wrongInput = true;
        $categoryError = "Please fill in a number!";
    }

    return $wrongInput;
}

function validateCategoryInput(string $action):bool {
    global $titleError;
    global $descriptionError;
    global $imageError;

    $titleInput = $_POST["$action-title"];
    $descriptionInput = $_POST["$action-desc"];
    $imageInput = $_POST["$action-img"];

    $result = validateSharedEditInputs($titleInput, $descriptionInput, $imageInput);
    $wrongInput = $result["wrong_input"];
    $titleError = $result["title_error"];
    $descriptionError = $result["desc_error"];
    $imageError = $result["img_error"];

    return $wrongInput;
}

function loadRelatedEditContent():string|null {
    global $params;
    $includeFile = null;

    if ($params[3] == "product") {
        getProductEditData($params[4]);
        $includeFile = "../Templates/defaults/edit-product.php";
    } else if ($params[3] == "category") {
        getCategoryEditData($params[4]);
        $includeFile = "../Templates/defaults/edit-category.php";
    } else {
        header("Location: home");
        return null;
    }

    return $includeFile;
}

function validateSharedEditInputs($title, $desc, $img):array {
    $wrongInput = false;
    $titleError = null;
    $descriptionError = null;
    $imageError = null;

    if (empty($title)) {
        $wrongInput = true;
        $titleError = "Please fill this field in!";
    } else if (strlen($title) > 255) {
        $wrongInput = true;
        $titleError = "Length must be 255 or less!";
    }

    if (empty($desc)) {
        $wrongInput = true;
        $descriptionError = "Please fill this field in!";
    }

    if (empty($img)) {
        $wrongInput = true;
        $imageError = "Please fill this field in!";
    } else if (strlen($img) > 255) {
        $wrongInput = true;
        $imageError = "Length must be 255 or less!";
    }

    $result["wrong_input"] = $wrongInput;
    $result["title_error"] = $titleError;
    $result["desc_error"] = $descriptionError;
    $result["img_error"] = $imageError;

    return $result;
}

/**
 * Validates the editing of cards using method _POST.
 * @return null
 */
function validateCardEdit() {
    //Inputs
    global $titleInput;
    global $descriptionInput;
    global $imageInput;
    //Error fields
    global $titleError;
    global $descriptionError;
    global $imageError;
    global $mainErrorField;
    if (isset($_POST["edit-category-submit"])) {
        $titleInput = $_POST["edit-title"];
        $descriptionInput = $_POST["edit-desc"];
        $imageInput = $_POST["edit-img"];

        $result = validateSharedEditInputs($titleInput, $descriptionInput, $imageInput);
        $wrongInput = $result["wrong_input"];
        $titleError = $result["title_error"];
        $descriptionError = $result["desc_error"];
        $imageError = $result["img_error"];

        if (!$wrongInput) {
            global $params;

            if (isset($params[4])) {
                $id = $params[4];
                if (updateCategoryTable($id, $titleInput, $imageInput, $descriptionInput)) {
                    $mainErrorField = "Card successfully edited!";
                    header("Location: /admin/categories");
                } else {
                    $mainErrorField = "Something went wrong while attempting a connection with the database! Please contact a developer for further information";
                }
            } else {
                $mainErrorField = "Something went wrong, please try editing another card!";
            }
        } else {
            $mainErrorField = "Please fill in all fields correctly!";
        }
    } else if (isset($_POST["edit-product-submit"])) {
        //Make category values global, as they are only used inside the product tab
        global $categoryInput;
        global $categoryError;

        $titleInput = $_POST["edit-title"];
        $descriptionInput = $_POST["edit-desc"];
        $imageInput = $_POST["edit-img"];
        $categoryInput = $_POST["edit-category"];

        $result = validateSharedEditInputs($titleInput, $descriptionInput, $imageInput);
        $wrongInput = $result["wrong_input"];
        $titleError = $result["title_error"];
        $descriptionError = $result["desc_error"];
        $imageError = $result["img_error"];

        if (!filter_input(INPUT_POST, 'edit-category', FILTER_VALIDATE_INT)) {
            $wrongInput = true;
            $categoryError = "Please fill in a number!";
        }

        if (!$wrongInput) {
            global $params;

            if (isset($params[4])) {
                $id = $params[4];
                if (updateProductTable($id, $titleInput, $imageInput, $descriptionInput, $categoryInput)) {
                    $mainErrorField = "Card successfully edited!";
                    header("Location: /admin/category/$categoryInput");
                } else {
                    $mainErrorField = "Something went wrong while attempting a connection with the database! Please contact a developer for further information";
                }
            } else {
                $mainErrorField = "Something went wrong, please try editing another card!";
            }
        } else {
            $mainErrorField = "Please fill in all fields correctly!";
        }
    }

    return null;
}

function getCategoryEditData(int $categoryId) {
    $category = getSingleCategory($categoryId);

    if (count($category) > 0) {
        global $titleInput;
        global $descriptionInput;
        global $imageInput;

        $category = $category[0];

        $titleInput = $category->name;
        $descriptionInput = $category->description;
        $imageInput = $category->picture;
    }

    return null;
}

function getProductEditData(int $productId) {
    $product = getSingleProduct($productId);
    if (count($product) > 0) {
        global $titleInput;
        global $descriptionInput;
        global $imageInput;
        global $categoryInput;

        $product = $product[0];

        $titleInput = $product->name;
        $descriptionInput = $product->description;
        $imageInput = $product->picture;
        $categoryInput = $product->category_id;
    }

    return null;
}

/**
 * Function made as a final check to delete a card, used for products and categories.
 * @return string|null returns either the final confirm button or null if nothing happened or has to be returned.
 */
function checkForDeleteFinalConfirm():string|null {
    global $params;

    if (isset($_POST["confirm-delete"])) {//Final confirmation to delete
        if (isset($params[3])) {
            return "<input type='submit' name='final-confirm-delete' value='I REALLY WANT TO DELETE THIS $params[3]'>";
        }

        return "<input type='submit' name='final-confirm-delete' value='I REALLY WANT TO DELETE THIS'>";
    } else if (isset($_POST["final-confirm-delete"])) {//Executes deletion
        if (isset($params[3])) {
            if ($params[3] == "category") {
                if (deleteCategory($params[4])) {
                    echo "success";
                    header("Location: /home");
                }
            } else if ($params[3] == "product") {
                if (deleteProduct($params[4])) {
                    echo "success";
                    header("Location: /home");
                }
            }
        }

        return "true";
    }

    return null;
}

function deleteCategory(int $id):bool {
    global $pdo;

    $query = $pdo->prepare("DELETE FROM category WHERE id=:id");
    $query->bindParam("id", $id);

    if ($query->execute()) {
        return true;
    }

    return false;
}

function deleteproduct(int $id):bool {
    global $pdo;

    $query = $pdo->prepare("DELETE FROM product WHERE id=:id");
    $query->bindParam("id", $id);

    if ($query->execute()) {
        return true;
    }

    return false;
}

/**
 * @return bool is returned after function execution. True if everything went well, false if content has not been pushed to the database.
 */
function addToCategory(string $name, string $picture, string $description):bool {
    global $pdo;

    $visits = 0;

    $query = $pdo->prepare("INSERT INTO category(name, picture, description, visits) VALUES(:name, :picture, :description, :visits)");
    $query->bindParam("name", $name);
    $query->bindParam("picture", $picture);
    $query->bindParam("description", $description);
    $query->bindParam("visits", $visits);

    if ($query->execute()) {
        return true;
    }

    return false;
}

/**
 * @return bool is returned after function execution. True if everything went well, false if content has not been pushed to the database.
 */
function addToProduct(string $name, string $picture, string $description, int $categoryId):bool {
    global $pdo;

    $visits = 0;

    $query = $pdo->prepare("INSERT INTO product(name, picture, description, visits, category_id) VALUES(:name, :picture, :description, :visits, :category_id)");
    $query->bindParam("name", $name);
    $query->bindParam("picture", $picture);
    $query->bindParam("description", $description);
    $query->bindParam("visits", $visits);
    $query->bindParam("category_id", $categoryId);

    if ($query->execute()) {
        return true;
    }

    return false;
}
/**
 * Validates the creating of cards using method _POST.
 * @return null
 */
function validateCardCreation() {
    //Inputs
    global $titleInput;
    global $descriptionInput;
    global $imageInput;
    //Error fields
    global $titleError;
    global $descriptionError;
    global $imageError;
    global $mainErrorField;

    if (isset($_POST["add-category-submit"])) {
        $titleInput = $_POST["add-title"];
        $descriptionInput = $_POST["add-desc"];
        $imageInput = $_POST["add-img"];

        $result = validateSharedEditInputs($titleInput, $descriptionInput, $imageInput);
        $wrongInput = $result["wrong_input"];
        $titleError = $result["title_error"];
        $descriptionError = $result["desc_error"];
        $imageError = $result["img_error"];

        if (!$wrongInput) {
            global $params;

            if (isset($params[3])) {
                if (addToCategory($titleInput, $imageInput, $descriptionInput)) {
                    $mainErrorField = "Card successfully created!";
                    header("Location: /admin/categories");
                } else {
                    $mainErrorField = "Something went wrong while attempting a connection with the database! Please contact a developer for further information";
                }
            } else {
                $mainErrorField = "Something went wrong, please try editing another card!";
            }
        } else {
            $mainErrorField = "Please fill in all fields correctly!";
        }
    } else if (isset($_POST["add-product-submit"])) {
        //Make category values global, as they are only used inside the product tab
        global $categoryInput;
        global $categoryError;

        $titleInput = $_POST["add-title"];
        $descriptionInput = $_POST["add-desc"];
        $imageInput = $_POST["add-img"];
        $categoryInput = $_POST["add-category"];

        $result = validateSharedEditInputs($titleInput, $descriptionInput, $imageInput);
        $wrongInput = $result["wrong_input"];
        $titleError = $result["title_error"];
        $descriptionError = $result["desc_error"];
        $imageError = $result["img_error"];

        if (!filter_input(INPUT_POST, 'add-category', FILTER_VALIDATE_INT)) {
            $wrongInput = true;
            $categoryError = "Please fill in a number!";
        }

        if (!$wrongInput) {
            global $params;

            if (isset($params[3])) {
                if (addToProduct($titleInput, $imageInput, $descriptionInput, $categoryInput)) {
                    $mainErrorField = "Card successfully created!";
                    header("Location: /admin/category/$categoryInput");
                } else {
                    $mainErrorField = "Something went wrong while attempting a connection with the database! Please contact a developer for further information";
                }
            } else {
                $mainErrorField = "Something went wrong, please try editing another card!";
            }
        } else {
            $mainErrorField = "Please fill in all fields correctly!";
        }
    }

    return null;
}