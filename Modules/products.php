<?php
function getProducts($id):array
{
    //$pdo is the connection to the database.
    global $pdo;
    /*
     * this will collect all the categories from the category table and makes objects from the category class.
     * check Category.php in the Classes folder.
     */
    $products = $pdo->query("SELECT * FROM product WHERE category_id=$id")->fetchAll(PDO::FETCH_CLASS, 'Product');
    //gives back all the category objects
    return $products;
}

function getSingleProduct($requestedId):array {
    //$pdo is the connection to the database.
    global $pdo;
    /*
     * this will collect all the categories from the category table and makes objects from the category class.
     * check Category.php in the Classes folder.
     */
    $query = $pdo->prepare('SELECT * FROM product WHERE id=:id limit 1');
    $query->bindParam("id", $requestedId);
    $query->execute();
    //gives back all the category objects
    return $query->fetchAll(PDO::FETCH_CLASS, 'Category');
}

function getProductDetails($id):array
{
    //$pdo is the connection to the database.
    global $pdo;
    /*
     * this will collect all the categories from the category table and makes objects from the category class.
     * check Category.php in the Classes folder.
     */
    $productDetails = $pdo->query("SELECT * FROM product WHERE id=$id")->fetchAll(PDO::FETCH_CLASS, 'Product');
    //gives back all the category objects
    return $productDetails;
}

function loadReviews($id):string|null {
    global $pdo;//Database connection
    $reviewMessages = null;
    //Fetches the reviews
    $pageReviews = $pdo->query("SELECT * FROM review WHERE product_id=$id")->fetchAll(PDO::FETCH_CLASS, 'Review');

    foreach ($pageReviews as $review) {
        //Fetches the user
        $user = $pdo->query("SELECT * FROM registered_user WHERE id=" . $review->registered_user_id)->fetchAll(PDO::FETCH_CLASS, 'User');
        $user = $user[0];//Grabs the first index

        $userReviewInfo = $user->first_name;//Fetches first name

        //Fetches last name if it exists.
        if (isset($user->last_name)) {
            $userReviewInfo .= " " . $user->last_name;
        }

        //Fetches review info
        $userReviewMessage = $review->message;
        $userReviewRating = $review->rating;
        $userReviewTime = $review->publish_time;

        //Loads the review message HTML
        $reviewMessages .= "    <div class='card bg-dark'>
        <div class='card-header bg-secondary'>$userReviewInfo</div>
        <div class='card-body'>
            <div class='card-text'>$userReviewMessage</div>
            <div class='text-muted'>-- $userReviewRating --</div>
        </div>
        <div class='card-footer bg-secondary'>$userReviewTime</div>
    </div>";
    }

    return $reviewMessages;
}