<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
global $params;

global $productImages;
global $categoryImages;

global $selectedDeleteProduct;
global $selectedDeleteCategory;
global $loadSelectedDelete;

global $catDeletePath;
global $productDeletePath;

global $deleteConfirm;

if (!isset($deleteConfirm)) {
    $deleteConfirm = "<input type='submit' name='confirm-delete' value='DELETE THIS IMAGE'>";
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
                <li class="breadcrumb-item"><a href="/admin/image-editing">Admin - Image editing</a></li>
            </ol>
        </nav>
        <div class="row gy-3 text-center">
            <h2>Delete image</h2>
            <?php if ($loadSelectedDelete): ?>
                <form method="post" class="row text-light text-center">
                    <label for="categorySelect">Select category image to delete</label>
                    <select name="selected-delete-category" id="categorySelect">
                        <option value='non-select'>-</option>
                        ";
                        <?php echoArrayContents($categoryImages, "<option value=#replace>", "</option>"); ?>
                    </select>
                    <label for="productSelect">Select product image to delete</label>
                    <select name="selected-delete-product" id="productSelect">
                        <?php
                        //LIST THE IMAGES OF THE PRODUCTS OF THE CATEGORIES
                        foreach ($productImages as $key => $images) {
                            echo "<option value='non-select'>-</option>";
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
                    <?= $deleteConfirm; ?>
                </form>
            <?php else: ?>
                <div class="col-12 fs-3">
                    Deleting an <br><span class="fw-bold fs-2">image</span><br> will permanently remove it from
                    existence!
                </div>
                <?php if (isset($catDeletePath)): //Show category if selected ?>
                    <div class="fs-3 fw-bold"><u>Category image</u> you're deleting:</div>
                    <img src='<?= $catDeletePath; ?>' class='img-fluid' alt='Image of <?= $catDeletePath ?>'>
                <?php endif; ?>
                <?php if (isset($productDeletePath)): //Show product if selected ?>
                    <div class="fs-3 fw-bold"><u>Product image</u> you're deleting:</div>

                    <img src='<?= $productDeletePath; ?>' class='img-fluid' alt='Image of <?= $productDeletePath ?>'>
                <?php endif; ?>
                <div class="col-12 fs-4"></div>
                <form method="post" class="row text-light text-center">
                    <div class="col-12">
                        <hr>
                        <br>
                        <div class="fs-1">Confirmation:</div>
                    </div>
                    <a href="/admin/categories">
                        <button>GO BACK, I DON'T WANT TO DELETE ANY IMAGE</button>
                    </a>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <?= $deleteConfirm; ?>
                </form>
            <?php endif; ?>
            <a href="/admin/image-creating">Click here to <b><u>add</u></b> images instead</a>