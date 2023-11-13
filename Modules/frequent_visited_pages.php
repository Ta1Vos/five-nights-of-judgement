<?php

$frequentlyVisitedPages = "";
$mostVisited = [];

include "database.php";
global $pdo;

$query = $pdo->prepare("SELECT * FROM product");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $product) {//Loops through all categories
    for ($i = 0; $i <= count($mostVisited); $i++) {//Loops through the 3 most visited pages
        if (count($mostVisited) <= 2) {
            $mostVisited[] = $product; //If there's less than 3 categories, automatically fill them up
            break;
        } else if ($product['visits'] >= $mostVisited[$i]['visits']) {
            $mostVisited[$i] = $product; //Replace a product if it has fewer visits than the one its being compared to.
            break;
        }
    }
}

if (count($mostVisited) > 0) {
    //Echoes the most popular categories
    for ($i = 0; $i < count($mostVisited); $i++) {
        $product = $mostVisited[$i];

        $frequentlyVisitedPages .= "<div class='card bg-dark mx-2 border border-3 border-dark rounded-2' style='width: 18rem;'>
  <img src='/img/{$product["picture"]}' class='card-img-top' alt='Image of product'>
  <div class='card-body'>
  <p class='card-title'>{$product["name"]}</p>
  <a href='/product/{$product["id"]}' class='stretched-link'></a>
  </div>
</div>";
    }
} else {
    $frequentlyVisitedPages = "<b class='text-light'>Something went wrong</b>";
}

//var_dump($frequentlyVisitedPages);
//echo "<br><br>";

?>