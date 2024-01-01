<?php
/**
 * Load the review messages of a page with its identifier.
 * @param int $id Required | The identifier of the page you're requesting the id from.
 * @return string|null Either returns
 */
function loadReviews(int $id):array|false {
    global $pdo;//Database connection

    //Fetches the reviews
    $pageReviews = $pdo->prepare("SELECT * FROM review WHERE product_id=:id");
    $pageReviews->bindParam("id", $id);

    if (!$pageReviews->execute()) {
        return false;
    }

    $reviewMessages = $pageReviews->fetchAll(PDO::FETCH_CLASS, 'Review');

    if ($reviewMessages <= 0) {
        $reviewMessages = false;
    }

    return $reviewMessages;
}