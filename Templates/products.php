<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('defaults/head.php');
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
                <li class="breadcrumb-item"><a href="/category/<?php if(isset($params[2])){$params[2];} ?>">Products</a></li>
            </ol>
        </nav>
        <div class="row gy-3">
            <!--
                this will loop through all the categories as category.
                because category is an object you use "->" to get the specific data.
                so if you want to see the id from a category you type $category->id
            -->
            <?php global $products; ?>
            <?php foreach ($products as $product): ?>
                <div class="col-sm-4 col-md-3 card-group">
                    <div class='card bg-dark mx-2 border border-3 border-dark rounded-2' style='width: 18rem;'>
                        <img src='/img/<?= $product->picture; ?>' class='card-img-top' alt='Image of $pageType'>
                        <div class='card-body'>
                            <h5 class='card-title text-white'><?= $product->name; ?></h5>
                            <hr>
                            <p class="card-text text-light"><?= $product->description; ?></p>
                            <a href='/product/<?= $product->id; ?>' class='stretched-link'></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <hr>
    </div>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

