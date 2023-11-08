<?php
//This file will load the content info the navbar
include "database.php";
global $pdo;

$navbarCategoryContent = null;
$navbarToggleRedirect = "/categories.php";

$query = $pdo->prepare("SELECT * FROM category");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

//Loops through the categories
foreach ($result as $item) {
    //Places category names in the dropdown in the navbar.
    //This counts as a quick link, so you don't have to visit the categories page.
    $navbarCategoryContent .= "<a href='/category/{$item['id']}'>{$item['name']}</a><br>";
}