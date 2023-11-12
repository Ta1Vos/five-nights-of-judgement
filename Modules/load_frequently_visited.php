<?php

$frequentlyVisitedPages = "";
$mostVisited = [];

include "database.php";
global $pdo;

$query = $pdo->prepare("SELECT * FROM category");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $category) {//Loops through all categories
    for ($i = 0; $i <= count($mostVisited); $i++) {//Loops through the 3 most visited pages
        if (count($mostVisited) <= 2) {
            $mostVisited[] = $category; //If there's less than 3 categories, automatically fill them up
            break;
        } else if ($category['visits'] >= $mostVisited[$i]['visits']) {
            $mostVisited[$i] = $category; //Replace a category if it has fewer visits than the one its being compared to.
            break;
        }
    }
}

if (count($mostVisited) > 0) {
    //Echoes the most popular categories
    for ($i = 0; $i < count($mostVisited); $i++) {
        $category = $mostVisited[$i];

        $frequentlyVisitedPages .= "<div class='card bg-dark mx-2' style='width: 18rem;'>
  <img src='/img/{$category["picture"]}' class='card-img-top' alt='Image of category'>
  <div class='card-body'>
  <p class='card-title'>{$category["name"]}</p>
  <a href='/category/{$category["id"]}' class='stretched-link'></a>
  </div>
</div>";
    }
} else {
    $frequentlyVisitedPages = "<b class='text-light'>Something went wrong</b>";
}

//var_dump($frequentlyVisitedPages);
//echo "<br><br>";

?>