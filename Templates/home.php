<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
?>
<body>
<div class="container bg-dark">
    <?php
    //            include_once ('defaults/header.php');
    include_once('defaults/menu.php');
    //            include_once ('defaults/pictures.php');
    ?>
    <div class="bg-black text-light text-center">

        <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <h3>Home</h3>
        <br>
        <small class="text-muted">This is the info of this page to show you how the lay-out looks like for our project.</small>
        <br><br>
        <div class="fs-4">Popular pages</div>
        <div class="row">
            <div class="col"></div>
            <div class="col-6 card-group">
                <?php if (!empty($frequentlyVisitedPages)) {
                    echo $frequentlyVisitedPages;
                }?>
            </div>
            <div class="col"></div>
        </div>
        <hr>
    </div>
    <?php
    include_once('defaults/footer.php');
    ?>
</div>
</body>
</html>
