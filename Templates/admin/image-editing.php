<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
global $params;

global $productImages;
global $categoryImages;
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
                <li class="breadcrumb-item"><a href="/<?= $params[1] ?>/add/<?= $params[3] ?>">Admin - Category
                        Creating</a></li>
            </ol>
        </nav>
        <div class="row gy-3 text-center">
            <h2>Upload image</h2>
            <form method="post" enctype="multipart/form-data" class="row text-light text-center">
                Choose image to upload:
                <label>
                    <input type="file" name="fileUpload" id="fileToUpload">
                </label>
                <label>
                    <input type="submit" name="submit-fileUpload" value="Upload image">
                </label>
            </form>
            <br><br><br><br><br><br><br>
            <h2>Delete image</h2>
            <form method="post" class="row text-light text-center">
                <label for="categorySelect">Select category image to delete</label>
                <select name="select-categories" id="categorySelect">
                    <?php echoArrayContents($categoryImages, "<option value=#replace>", "</option>"); ?>
                </select>
                <label for="categorySelect">Select product image to delete</label>
                <select name="select-products" id="categorySelect">
                    <?php
                    foreach ($productImages as $key => $images) {
                        echo "<option value='non-select'></option>";
                        echo "<option value='non-select'>---$key---</option>";
                        echo "<option value='non-select'></option>";
                        echoArrayContents($images, "<option value=#replace>", "</option>");
                    }
                    ?>
                </select>
                <div class="col-12 fs-3">
                    Deleting an <br><span class="fw-bold fs-2">image</span><br> will permanently remove it from
                    existence!
                </div>
                <div class="col-12">
                    <hr>
                    <br>
                    <div class="fs-1">Confirmation:</div>
                </div>
                <a href="/admin/categories">
                    <button>GO BACK, I DON'T WANT TO DELETE ANY IMAGE</button>
                </a>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <input type="submit" name="delete-confirm" value="Delete image">
                <label>

                </label>
            </form>