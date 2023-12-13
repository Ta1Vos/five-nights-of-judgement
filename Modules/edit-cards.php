<?php

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