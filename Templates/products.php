<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('defaults/head.php');
?>

<body>

<div class="container">
    <?php
    //adds the rest of the default files.
    include_once('defaults/header.php');
    include_once('defaults/menu.php');
    include_once('defaults/pictures.php');
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/categories">Categories</a></li>
        </ol>
    </nav>
    <div class="row gy-3 ">
        <!--
            this will loop through all the categories as category.
            because category is an object you use "->" to get the specific data.
            so if you want to see the id from a category you type $category->id
        -->
        <?php global $products ?>
        <?php foreach ($products as $product): ?>
            <div class="col-sm-4 col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="/category/<?= $product->id ?>">
                            <img class="product-img img-responsive center-block" src='/img/<?= $product->picture ?>'/>
                        </a>
                        <div class="card-title mb-3"><?= $product->name ?></div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <hr>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

