<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
global $adminEditor;
global $params;

global $review;

global $confirmBtn;

if (!isset($confirmBtn))
    $confirmBtn = null;

?>

<body>

<div class="container bg-dark">
    <?php
    //adds the rest of the default files.
    include_once('../Templates/defaults/header.php');
    include_once('defaults/menu.php');
    //    include_once('defaults/pictures.php');
    ?>

    <div class="bg-black text-light text-center p-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="/<?= $params[1] ?>/delete/<?= $params[3] ?>/<?= $params[4] ?>">Admin - Manage review</a></li>
            </ol>
        </nav>
        <div class="row gy-3 text-center d-flex justify-content-center flex-row">
            <?php $reviewSender = searchUserByID($review->registered_user_id);
            $rating = $review->rating / 2;
            $halfStar = false;
            $emptyStars = 5;

            if ($rating != floor($rating)) {
            $rating -= 1;
            $halfStar = true;
            }
            ?>
            <div class="row">
                <div class="col-2"></div>
                <div class="card col-8 bg-dark p-0 my-5">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6 card-header bg-secondary">
                            <?= $reviewSender->first_name ?> <?= $reviewSender->last_name ?>
                        </div>
                    </div>
                    <div class="py-3">
                        <?= $review->message ?>
                    </div>
                    <div class="card-header bg-secondary">
                        --&nbsp;
                        <?php
                        //ECHOES THE RATING
                        for ($i=0; $i<$rating; $i++) {
                            echo "<i class='bi bi-star-fill mx-1'></i>";
                            $emptyStars--;
                        }
                        if ($halfStar) {
                            echo "<i class='bi bi-star-half mx-1'></i>";
                            $emptyStars--;
                        }
                        //ECHOES EMPTY STARS
                        for ($i=0; $i<$emptyStars; $i++) {
                            echo "<i class='bi bi-star mx-1'></i>";
                        }
                        ?>
                        &nbsp;--
                    </div>
                    <small class="border-top border-1 border-dark">
                        <?= $review->publish_time ?>
                    </small>
                </div>
                <div class="col-2"></div>
            </div>
            <form method="post">
                <div class="row">
                    <div class="col-6">
                        <h5>Remove review</h5>
                        <label for="remove">Keeps the post, removes the message</label><br>
                        <input type="submit" name="remove-review" value="Remove review" class="btn btn-light mb-3" id="remove"><br>
                        <label for="remove">Completely remove the post</label><br>
                        <input type="submit" name="force-remove-review" value="Delete review" class="btn btn-light mb-3" id="delete"><br>
                    </div>
                </div>
                <div class="confirm">
                    <?= $confirmBtn; ?>
                </div>
            </form>
        </div>

        <hr>
    </div>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

