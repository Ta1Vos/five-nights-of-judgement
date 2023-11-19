<?php

function calculateFrequentlyVisited($dbTable)
{
    if (isset($dbTable)) {
        $mostVisited = [];

        include "database.php";
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM $dbTable");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (isset($result[0]["visits"])) {
            foreach ($result as $category) {//Loops through all categories
                for ($i = 0; $i <= count($mostVisited); $i++) {//Loops through the 3 most visited pages
                    if (count($mostVisited) <= 2) {
                        $mostVisited[] = $category; //If there's less than 3 categories, automatically fill them up
                        break;
                    } else if (isset($mostVisited[$i]) && $category['visits'] >= $mostVisited[$i]["visits"]) {
                        $mostVisited[$i] = $category; //Replace a category if it has fewer visits than the one its being compared to.
                        break;
                    }
                }
            }

            return $mostVisited;
        }
    }

    return "Something went wrong!";
}

function loadCardContents($mostVisited, $pageType)
{
    if (is_array($mostVisited) && isset($pageType)) {
        $cardContents = "";

        if (count($mostVisited) > 0) {
            //Echoes the most popular categories
            for ($i = 0; $i < count($mostVisited); $i++) {
                $category = $mostVisited[$i];

                $cardContents .= "<div class='card bg-dark mx-2 border border-3 border-dark rounded-2' style='width: 18rem;'>
  <img src='/img/{$category["picture"]}' class='card-img-top' alt='Image of $pageType'>
  <div class='card-body'>
  <p class='card-title'>{$category["name"]}</p>
  <a href='/$pageType/{$category["id"]}' class='stretched-link'></a>
  </div>
</div>";
            }
        } else {
            $cardContents = "<b class='text-light'>Something went wrong</b>";
        }

        return $cardContents;
    }

    return "Something went wrong!";
}