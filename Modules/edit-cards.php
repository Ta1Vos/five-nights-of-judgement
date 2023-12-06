<?php

function loadRelatedEditContent():string|null {
    global $params;
    $includeFile = null;

    if ($params[3] == "product") {
        $includeFile = "../Templates/defaults/edit-product.php";
    } else if ($params[3] == "category") {
        $includeFile = "../Templates/defaults/edit-category.php";
    } else {
        header("Location: home");
        return null;
    }

    return $includeFile;
}

function validateCardEdit() {
    if (isset($_POST[""])) {

    }
}