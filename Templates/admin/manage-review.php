<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
global $adminEditor;
global $params;
$firstLinkPiece = loadLinkContent();

if (!isset($firstLinkPiece)) {
    $firstLinkPiece = null;
}
global $deleteConfirm;

if (!isset($deleteConfirm)) {
    $deleteConfirm = "<input type='submit' name='confirm-delete' value='DELETE THIS PRODUCT'>";
}

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
            <div class="col-12 fs-1">
                Are you sure you wish to delete:
            </div>
            <div class="col-12 d-flex justify-content-center">
                <?php global $products; ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 card-group">
                        <div class='card bg-dark mx-2 border border-3 border-dark rounded-2' style='width: 18rem;'>
                            <img src='/img/<?= $product->picture; ?>' class='card-img-top' alt='Image of $pageType'>
                            <div class='card-body'>
                                <h5 class='card-title text-white'><?= $product->name; ?></h5>
                                <hr>
                                <p class="card-text text-light"><?= $product->description; ?></p>
                                <a href='<?= $firstLinkPiece; ?>category/<?= $product->id; ?>' class='stretched-link'></a><br>
                            </div>
                        </div>
                    </div>
                <?php $categoryId = $product->category_id;
                endforeach; ?>
            </div>
            <div class="col-12 fs-3">
                Deleting a <br><span class="fw-bold fs-2">product</span><br> will permanently remove it from existence! You can always create a new one.
            </div>
            <div class="col-12">
                <hr><br>
                <div class="fs-1">Confirmation:</div>
            </div>
            <a href="/category/<?= $categoryId; ?>"><button>GO BACK, I DON'T WANT TO DELETE THIS PRODUCT</button></a>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <form method="post" class="col-12">
                <?= $deleteConfirm; ?>
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

