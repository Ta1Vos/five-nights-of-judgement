<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('defaults/head.php');
global $adminEditor;
$firstLinkPiece = loadLinkContent();

if (!isset($firstLinkPiece)) {
    $firstLinkPiece = null;
}

global $createCard;

if (!isset($createCard)) {
    $createCard = null;
}
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
            </ol>
        </nav>
        <div class="row gy-3 text-center d-flex justify-content-center flex-row">
            <!--
                this will loop through all the categories as category.
                because category is an object you use "->" to get the specific data.
                so if you want to see the id from a category you type $category->id
            -->
            <?php global $categories; ?>
            <?php foreach ($categories as $category): ?>
                <div class="col-sm-6 col-md-4 col-lg-3 card-group">
                    <div class='card bg-dark mx-2 border border-3 border-dark rounded-2' style='width: 18rem;'>
                        <img src='/img/<?= $category->picture; ?>' class='card-img-top' alt='Image of $pageType'>
                        <div class='card-body'>
                            <h5 class='card-title text-white'><?= $category->name; ?></h5>
                            <hr>
                            <p class="card-text text-light"><?= $category->description; ?></p>
                            <a href='<?= $firstLinkPiece; ?>category/<?= $category->id; ?>' class='stretched-link'></a><br>
                        </div>
                        <?php if (function_exists("includeAdminToCards")) { echo includeAdminToCards("category", $category->id); } ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?= $createCard; ?>
        </div>

        <hr>
    </div>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>
</html>

