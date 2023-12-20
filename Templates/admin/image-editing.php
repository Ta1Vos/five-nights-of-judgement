<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
global $params;

global $titleInput;
global $descriptionInput;
global $imageInput;
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
                <li class="breadcrumb-item"><a href="/<?= $params[1] ?>/add/<?= $params[3] ?>">Admin - Category Creating</a></li>
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
                    <input type="submit" name="fileUpload" value="Upload image">
                </label>
            </form>
            <h2>Delete image</h2>