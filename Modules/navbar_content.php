<?php
function loadNavbarContent() {
    global $navbarCategoryContent;
    //This file will load the content info the navbar
    include "database.php";
    global $pdo;

    $navbarCategoryContent = null;
    $navbarToggleRedirect = "/categories.php";

    $result = fetchTable("category");
    if (!$result) {
        return null;
    }

//Loops through the categories
    foreach ($result as $item) {
        //Places category names in the dropdown in the navbar.
        //This counts as a quick link, so you don't have to visit the categories page.
        $navbarCategoryContent .= "<li class='nav-item'><a class='nav-link' href='/category/{$item['id']}'>{$item['name']}</a></li>";
    }

    return null;
}