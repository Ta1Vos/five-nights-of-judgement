<?php
/**
 * Load the review messages of a page with its identifier.
 * @param int $id Required | The identifier of the page you're requesting the id from.
 * @return string|null Either returns
 */
function loadReviews(int $id):array|false {
    global $pdo;//Database connection

    //Fetches the reviews
    $pageReviews = $pdo->prepare("SELECT * FROM review WHERE product_id=:id ORDER BY publish_time");
    $pageReviews->bindParam("id", $id);

    if (!$pageReviews->execute())
        return false;

    $reviewMessages = $pageReviews->fetchAll(PDO::FETCH_CLASS, 'Review');

    if (count($reviewMessages) <= 0)
        return false;

    return $reviewMessages;
}

/**
 * Load a review message using an identifier.
 * @param int $id Required | The identifier of the review you're requesting the id from.
 * @return false|object Either returns false if the fetch fails or the review (object).
 */
function fetchSingleReview(int $id):false|object {
    try {
        global $pdo;//Database connection

        //Fetches the reviews
        $pageReviews = $pdo->prepare("SELECT * FROM review WHERE id=:id limit 1");
        $pageReviews->bindParam("id", $id);

        if (!$pageReviews->execute())
            return false;

        $reviewMessages = $pageReviews->fetchAll(PDO::FETCH_CLASS, 'Review');

        if (count($reviewMessages) <= 0)
            return false;

        return $reviewMessages[0];
    } catch (PDOException $exception) {
        echo $exception;
    }

    return false;
}

function validateReview(string $description = "", mixed $rating = ""):bool {
    global $description;
    global $rating;

    global $descriptionError;
    global $ratingError;

    $inputValid = true;

    if (empty($description)) {//Check if description has been filled in
        $descriptionError = "You must fill something in in the description!";
        $inputValid = false;
    }

    if (isset($rating)) {//Check if rating has been filled in
        if (filter_input(INPUT_POST, "review-rating", FILTER_VALIDATE_INT)) {//Check if it's an integer
            if ($rating < 0 || $rating > 10) {//Check if the rating is in between 0-10
                $ratingError = "You must fill in a number inbetween 0 and 10!";
                $inputValid = false;
            }
        } else {
            $ratingError = "You must fill in a number!";
            $inputValid = false;
        }
    } else {
        $ratingError = "You must fill something in in the ratings!";
        $inputValid = false;
    }

    return $inputValid;
}

function createReview(string $description, int $rating, int $userId):bool {
    try {
        global $pdo;
        global $params;
        $dateTime = date("Y-m-d H:i:s");
        $productId = $params[3];

        $query = $pdo->prepare("INSERT INTO review SET message=:description, rating=:rating, publish_time=:dateTime, product_id=:productId, registered_user_id=:userId");
        $query->bindParam("description", $description);
        $query->bindParam("rating", $rating);
        $query->bindParam("dateTime", $dateTime);
        $query->bindParam("productId", $productId);
        $query->bindParam("userId", $userId);

        if ($query->execute()) {
            return true;
        }
    } catch (PDOException $exception) {
        global $notificationField;
        echo "<br><small>$exception</small><br>";
        $notificationField = "<span class='error-field'>Something went wrong upon trying to publish your review. Please contact an administrator!</span>";
    }

    return false;
}

/**
 * Remove a review from the database
 * @param int $id Required | The identifier of the review you wish to delete.
 * @return bool
 */
function deleteReview(int $id):bool {
    try {
        global $pdo;

        $query = $pdo->prepare("DELETE FROM review WHERE id=:id limit 1");
        $query->bindParam("id", $id);

        if ($query->execute()) {
            return true;
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: <br> $exception";
    }

    return false;
}

function editReviewMessage(int $id, string $message):bool {
    try {
        global $pdo;

        $query = $pdo->prepare("UPDATE review SET message=:message WHERE id=:id");
        $query->bindParam("id", $id);
        $query->bindParam("message", $message);

        if ($query->execute()) {
            return true;
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: <br> $exception";
    }

    return false;
}

function loadManageReviewSubmit(object $review) {
    global $confirmBtn;

    if (isset($_POST["remove-review"])) {
        $confirmBtn = "<input type='submit' name='confirm-remove-review' value='Confirm remove' class='btn btn-light mb-3'><br>";
    } else if (isset($_POST["force-remove-review"])) {
        $confirmBtn = "<input type='submit' name='confirm-force-remove-review' value='Confirm delete' class='btn btn-light mb-3'><br>";
    }

    if (isset($_POST["confirm-remove-review"])) {
        if (!editReviewMessage($review->id, "<i>[ This post has been removed ]</i>")) {
            echo "Something went wrong upon attempting to remove the review";
        } else {
            header("Location: /admin/home");
        }

    } else if (isset($_POST["confirm-force-remove-review"])) {
        if (!deleteReview($review->id)) {
            echo "Something went wrong upon attempting to remove the review from the database.";
        } else {
            header("Location: /admin/home");
        }
    }

    return null;
}

function updatePositiveReviewRating(object $review):bool {
    try {
        global $pdo;

        $review = fetchSingleReview($review->id);//Refresh review

        if (!$review)
            return false;

        $rating = $review->review_positive_rating++;

        $query = $pdo->prepare("UPDATE review SET review_positive_rating=:positive_rating WHERE id=:id");
        $query->bindParam("id", $review->id);
        $query->bindParam("positive_rating", $rating);

        if ($query->execute()) {
            return true;
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: <br> $exception";
    }

    return false;
}

function updateNegativeReviewRating(object $review):bool {
    try {
        global $pdo;

        $review = fetchSingleReview($review->id);//Refresh review

        if (!$review)
            return false;

        $rating = $review->review_negative_rating++;

        $query = $pdo->prepare("UPDATE review SET review_negative_rating=:negative_rating WHERE id=:id");
        $query->bindParam("id", $review->id);
        $query->bindParam("negative_rating", $rating);

        if ($query->execute()) {
            return true;
        }
    } catch (PDOException $exception) {
        echo "Something went wrong: <br> $exception";
    }

    return false;
}

function editReviewRating(object $review) {
    if (isset($_POST["positive-rating"])) {
        updatePositiveReviewRating($review);
    } else if (isset($_POST["negative-rating"])) {
        updateNegativeReviewRating($review);
    }

    return null;
}