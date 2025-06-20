<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
$firstLinkPiece = loadLinkContent();
?>
<body>
<div class="container bg-dark">
    <?php
    include_once('defaults/header.php');
    include_once(loadCorrectIncludeFormat('defaults/menu.php'));
    ?>
    <div class="bg-black text-light text-center">

        <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <br>
        <h3>Home</h3>
        <br>
        <small class="text-muted">This is the info of this page to show you how the lay-out looks like for our
            project.</small>
        <br><br>
        <div class="container-fluid">
            <div class="fs-4">Popular categories</div>
            <div class="row d-flex justify-content-center">
                <div class="col-0 col-lg"></div>
                <div class="row col-12 col-lg-6 card-group">
                    <?php if (!empty($frequentlyVisitedCategories)) {
                        //Frequently Visited Categories based on visits
                        echo $frequentlyVisitedCategories;
                    } ?>
                </div>
                <div class="col-0 col-lg"></div>
            </div>
            <br>
            <a class="btn btn-light" href="<?= $firstLinkPiece; ?>categories" role="button">Go to the category page</a>
            <br><br>
            <hr>
        </div>
        <div class="container-fluid">
            <div class="fs-4">Popular pages</div>
            <div class="row d-flex justify-content-center">
                <div class="col-0 col-lg"></div>
                <div class="row col-12 col-lg-6 card-group">
                    <?php if (!empty($frequentlyVisitedPages)) {
                        //Frequently Visited Pages based on visits
                        echo $frequentlyVisitedPages;
                    } ?>
                </div>
                <div class="col-0 col-lg"></div>
            </div>
            <br>
            <hr>
        </div>
    </div>
    <?php
    include_once('defaults/footer.php');
    ?>
</div>
</body>
</html>
