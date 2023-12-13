<?php
/**
 * Returns the second params of the link to make links in html/navbar work.
 * @return string returns the string for the member, admin or regular user.
 */
function loadContent():string {
    if (isMember()) {
        return "/member/";//Returns member link
    } else if (isAdmin()) {
        return "/admin/";//Returns admin link
    }

    return "/";//Returns regular link
}
function loadNavbarContent() {
    global $navbarCategoryContent;
    //This file will load the content info the navbar
    include "database.php";
    global $pdo;

    $firstLinkPiece = loadContent();

    $navbarCategoryContent = null;

    $result = fetchTable("category");
    if (!$result) {
        return null;
    }

//Loops through the categories
    foreach ($result as $item) {
        //Places category names in the dropdown in the navbar.
        //This counts as a quick link, so you don't have to visit the categories page.
        $navbarCategoryContent .= "<li class='nav-item'><a class='nav-link' href='". $firstLinkPiece ."category/{$item['id']}'>{$item['name']}</a></li>";
    }

    return null;
}