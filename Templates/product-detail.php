<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('defaults/head.php');
global $product;
global $categoryName;
global $reviewMessages;
global $breadcrumbLink;
?>

<body>

<div class="container bg-dark">
    <?php
    //adds the rest of the default files.
    include_once('defaults/header.php');
    include_once(loadCorrectIncludeFormat('defaults/menu.php'));
    //    include_once('defaults/pictures.php');
    ?>

    <div class="bg-black text-light text-center p-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="categories">Categories</a></li>
                <?= $breadcrumbLink; ?>
            </ol>
        </nav>
        <div class="row gy-3">
            <div class="col-sm-12 d-flex flex-column">
                <h2><?= $product->name; ?></h2>
                <br><br>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-sm-12 col-md-4 align-self-center">
                        <img src='/img/<?= $product->picture; ?>' class='img-fluid' alt='Image of $pageType'>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <hr>
                <h4>Description</h4>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-12 col-md-6">
                        <p><?= $product->description; ?></p>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="reviews">
            <?php foreach ($reviewMessages as $reviewMessage):
                $reviewSender = searchUserByID($reviewMessage->registered_user_id);
                $rating = $reviewMessage->rating / 2;
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
                            <?php if (isAdmin())://Adds delete button for admin?>
                            <div class="col-3">
                                <a href="/admin/manage-review/<?= $reviewMessage->id; ?>" class="btn btn-light">Edit review</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="py-3">
                            <?= $reviewMessage->message ?>
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
                        <form method="post" class="member-rating pt-1 pb-1 bg-secondary">
                            <small>Is this review helpful?</small>
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="review-rate-positive" value="+1" class="rounded">
                                <i class="bi bi-hand-thumbs-up me-3 fs-4"></i>
                                <small>
                                    <?php echo $reviewMessage->review_positive_rating - $reviewMessage->review_negative_rating; ?>
                                </small>
                                <i class="bi bi-hand-thumbs-down ms-3 fs-4"></i>
                                <input type="submit" name="review-rate-negative" value="-1" class="rounded">
                            </div>
                        </form>
                        <small class="border-top border-1 border-dark py-1">
                            <?= $reviewMessage->publish_time ?>
                        </small>
                    </div>
                    <div class="col-2"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        if (isMember() || isAdmin()) {
            include_once "../Templates/member/place-reviews.php";
        }
        ?>
    </div>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

