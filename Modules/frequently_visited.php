<?php

function calculateFrequentlyVisited($dbTable): string|array
{
    if (isset($dbTable)) {
        $mostVisited = [];

        global $popularId;//Value for which row/column is created for the freq. visited.
        $popularId[0] = $dbTable;

        $result = fetchTable($dbTable);
        if(!$result) {
            return "Something went wrong!";
        };

        //Checks if the current result is either a product or a category
        if (isset($result[0]["visits"])) {
            foreach ($result as $category) {//Loops through all categories
                for ($i = 0; $i <= count($mostVisited); $i++) {//Loops through the 3 most visited pages
                    $popularId[1]++;

                    if (count($mostVisited) <= 2) {
                        $category["popular-id"] = $popularId;
                        $mostVisited[] = $category; //If there's less than 3 categories, automatically fill them up
                        break;
                    } else if (isset($mostVisited[$i]) && $category['visits'] >= $mostVisited[$i]["visits"]) {
                        $category["popular-id"] = $popularId;
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

//Loads in the cards for the certain pagetype of the frequently visited pages
function loadCardContents($mostVisited, $pageType)
{
    if (is_array($mostVisited) && isset($pageType)) {
        $firstLinkPiece = loadLinkContent();

        $cardContents = "";

        if (count($mostVisited) > 0) {
            //Echoes the most popular categories
            for ($i = 0; $i < count($mostVisited); $i++) {
                $category = $mostVisited[$i];

                $resetBtn = includeAdminToPopular($category);

                $cardContents .= "<div class='card col-12 col-xl-4 col-xxl-3 bg-dark mx-2 border border-3 border-dark rounded-2'>
  <img src='/img/{$category["picture"]}' class='card-img-top' alt='Image of $pageType'>
  <div class='card-body'>
  <p class='card-title'>{$category["name"]}</p>
  <a href='". $firstLinkPiece ."$pageType/{$category["id"]}' class='stretched-link'></a>
  </div>
  $resetBtn<br>
</div>";
            }
        } else {
            $cardContents = "<b class='text-light'>Something went wrong</b>";
        }

        return $cardContents;
    }

    return "Something went wrong!";
}

//Checks if requested category exists
function checkForProduct($requestedCategory): bool
{
    global $pdo;

    //Checks if category is a product
    $query = $pdo->prepare("SELECT * FROM product WHERE id = :id AND category_id = :category_id limit 1");
    $query->bindParam("id", $requestedCategory["id"]);
    $query->bindParam("category_id", $requestedCategory["category_id"]);//Category check included so it doesn't select category

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_CLASS, "Product");

    if (count($result) > 0) {
        return true;
    }

    return false;
}

//Checks if requested category exists
function checkForCategory($requestedCategory): bool
{
    global $pdo;

    //Checks if category is a category
    $query = $pdo->prepare("SELECT * FROM category WHERE id = :id limit 1");
    $query->bindParam("id", $requestedCategory["id"]);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_CLASS, "Category");

    if (count($result) > 0) {
        return true;
    }

    return false;
}

//Reset visits on products
function resetProductVisits($requestedCategory): bool
{
    global $pdo;

    $query = $pdo->prepare("UPDATE product SET visits = 0 WHERE id = :id");
    $query->bindParam("id", $requestedCategory["id"]);

    if ($query->execute()) {
        return true;
    }

    return false;
}

//Reset visits on category
function resetCategoryVisits($requestedCategory): bool
{
    global $pdo;

    $query = $pdo->prepare("UPDATE category SET visits = 0 WHERE id = :id");
    $query->bindParam("id", $requestedCategory["id"]);

    if ($query->execute()) {
        return true;
    }

    return false;
}

//Includes visit reset buttons
function includeAdminToPopular($category = null)
{
    global $params;

    if ($params[1] === "admin" && isAdmin() && isset($category)) {
        $popularId = $category["popular-id"];

        if (isset($_POST["popular-requested-submit-$popularId[0]-$popularId[1]"])) {
            unset($_POST);

            $requestedCategory = $category;

            //Check if category is a product/category, then reset the visits of selected id.
            if (checkForProduct($requestedCategory)) {
                resetProductVisits($requestedCategory);
            } else if (checkForCategory($requestedCategory)) {
                resetCategoryVisits($requestedCategory);
            }

            header("Refresh:0");//Refreshes page so visit count is up-to-date
        }

        return "<form method='post' class='z-5'><input type='submit' name='popular-requested-submit-$popularId[0]-$popularId[1]' value='reset visits ({$category["visits"]})'></form><br>";
    }

    return null;
}