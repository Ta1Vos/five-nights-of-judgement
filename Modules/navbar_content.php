<?php
function loadNavbarContent() {
    global $navbarCategoryContent;
    //This file will load the content info the navbar
    include "database.php";
    global $params;

    $firstLinkPiece = loadLinkContent();
    // BUG WITH ADMIN - ONLY SENDS TO ADMIN, EVEN WHEN IN 'USER' MODE WHILE ADMIN SESSION IS ACTIVE! TRY MAKE THIS NOT HAPPEN!
    //ISSUE IS THAT WITHOUT ANY / and /ADMIN/ IT DOES NOT DIRECT TO NUMBER

    $navbarCategoryContent = null;

    $result = fetchTable("category");
    if (!$result) {
        return null;
    }

//Loops through the categories
    foreach ($result as $item) {
        //Places category names in the dropdown in the navbar.
        //This counts as a quick link, so you don't have to visit the categories page.
        if ($params[1] == "member" || $params[1] == "admin") {
            $navbarCategoryContent .= "<li class='nav-item'><a class='nav-link' href='". $firstLinkPiece ."category/{$item['id']}'>{$item['name']}</a></li>";
        } else {
            $navbarCategoryContent .= "<li class='nav-item'><a class='nav-link' href='/category/{$item['id']}'>{$item['name']}</a></li>";
        }
    }

    return null;
}