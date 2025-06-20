<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
global $params;

global $titleInput;
global $descriptionInput;
global $imageInput;

global $titleInput;
global $descriptionInput;
global $imageInput;
global $categoryInput;
?>

<body>

<div class="container bg-dark">
    <?php
    //adds the rest of the default files.
    include_once('../Templates/defaults/header.php');
    include_once('menu.php');
    //    include_once('defaults/pictures.php');
    ?>

    <div class="bg-black text-light text-center p-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="/<?= $params[1] ?>/add/<?= $params[3] ?>">Admin - Product Creating</a></li>
            </ol>
        </nav>
        <div class="row gy-3 text-center">
            <form method="post" class="row text-light text-center">
                <div class="col-12 mb-5">
                    <div class="fs-3">Title</div>
                    <small class="error-field">
                        <?= $titleError; ?>
                    </small>
                    <br>
                    <label>
                        <input type="text" name="add-title" value="<?= $titleInput; ?>">
                    </label>
                </div>
                <div class="col-12 mb-5 d-flex justify-content-center flex-column">
                    <div class="fs-3">Description</div>
                    <small class="error-field">
                        <?= $descriptionError; ?>
                    </small>
                    <br>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <label class="input-group">
                                    <textarea class="form-control" name="add-desc"
                                    ><?= $descriptionInput; ?></textarea>
                            </label>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <div class="fs-3">Image</div>
                    <small class="error-field">
                        <?= $imageError; ?>
                    </small>
                    <br>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <label class="input-group">
                                    <textarea class="form-control" name="add-img"
                                    ><?= $imageInput; ?></textarea>
                            </label>
                        </div>
                        <div class="col-4"></div>
                    </div>
                    <a href="/admin/image-adding">Click here to <b><u>add</u></b> images</a><br><br>
                    <a href="/admin/image-deleting">Click here to <b><u>delete</u></b> images</a>
                </div>
                <div class="col-12 mb-5">
                    <div class="fs-3">Category</div>
                    <small class="error-field">
                        <?= $categoryError; ?>
                    </small>
                    <br>
                    <label>
                        <input type="text" name="add-category" value="<?= $categoryInput; ?>">
                    </label>
                </div>
                <br>
                <label class="mb-3">
                    <input type="submit" name="add-product-submit" value="Save changes">
                </label>
                <div class="error-field mb-3">
                    <?= $mainErrorField; ?>
                </div>
                <a href="/admin/home">Leave <b>without</b> saving</a>
            </form>