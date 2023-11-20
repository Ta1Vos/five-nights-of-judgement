<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('defaults/head.php');
global $product;
global $categoryName;
global $reviewMessages;
global $pageReviews;
?>

<body>

<div class="container bg-dark">
    <?php
    //adds the rest of the default files.
    include_once('defaults/header.php');
    include_once('defaults/menu.php');
    //    include_once('defaults/pictures.php');
    ?>

    <div class="bg-black text-light text-center p-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
                <li class="breadcrumb-item"><a href="/category/<?php if(isset($product->category_id)){echo $product->category_id;} ?>"><?= $categoryName; ?></a></li>
                <li class="breadcrumb-item"><a href="/product/<?php if(isset($product->id)){echo $product->id;} ?>"><?= $product->name ?></a></li>
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
            <?= $reviewMessages; ?>
        </div>
    </div>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

