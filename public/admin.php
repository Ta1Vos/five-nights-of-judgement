<?php
global $params;

//check if user has role admin
if (!isAdmin()) {
    logout();
    header("location:/home");
} else {
    require '../Modules/admin.php';

    echo "<br>";
    var_dump($params);
    echo "<br>";

    /*$params[1] is the admin role in case its being used.
     * $params[2] is the action (the page you are visiting).
     *$params[3] is parameter you give to the page.
     *the switch statement checks which page you want to go.
     */
    if (isset($params[2])) {
        switch ($params[2]) {

            case 'products':
                break;

            case 'add':
                break;

            case 'delete':
                break;

            default://Default is always home
                $titleSuffix = ' | Home';

                $popularId = [0, 0];//Value for which row/column is created for the freq. visited.
                $frequentlyVisitedCategories = calculateFrequentlyVisited("category");
                $popularId = [1, 0];
                $frequentlyVisitedPages = calculateFrequentlyVisited("product");

                $frequentlyVisitedCategories = loadCardContents($frequentlyVisitedCategories, "category");
                $frequentlyVisitedPages = loadCardContents($frequentlyVisitedPages, "product");
                include_once "../Templates/home.php";
                break;
        }
    } else {
        logout();
        header("location:/home");
    }
}