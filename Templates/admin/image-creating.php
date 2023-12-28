<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
global $params;

global $imageError;
global $imgDirLinks;
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
                <li class="breadcrumb-item"><a href="/admin/image-editing">Admin - Image editing</a></li>
            </ol>
        </nav>
        <div class="row gy-3 text-center">
            <h2>Upload image</h2>
            <form method="post" enctype="multipart/form-data" class="row text-light text-center">
                Choose image to upload:
                <label>
                    <input type="file" name="file-upload">
                </label>
                <label>
                    <input type="submit" name="submit-file-upload" value="Upload image">
                </label>
                <div class="pt-5">
                    Choose directory to upload image to:
                </div>
                <label>
                    <select name="selected-delete-product" id="productSelect">
                        <?php
                        //LIST THE DIRECTORIES WITH THEIR NAMES
                        foreach ($imgDirLinks as $key => $directory) {
                            //Check if directory contains subdirectories
                            if (!is_array($directory)) {
                                echo "<option value='non-select'></option>";
                                echo "<option value='$key'>$key</option>";
                            } else {
                                echo "<option value='non-select'>-</option>";
                                echo "<option value='$key'>-$key-</option>";
                                //LISTS SUBDIRECTORIES
                                foreach ($directory as $subdirectoryKey => $item) {
                                    echo "<option value='non-select'>--</option>";
                                    echo "<option value='$subdirectoryKey'>$key--$subdirectoryKey--</option>";
                                }

                                echo "<option value='non-select'></option>";
                            }
                        }
                        ?>
                    </select>
                </label>
            </form>
            <div class="error-field">
                <?= $imageError; ?>
            </div>