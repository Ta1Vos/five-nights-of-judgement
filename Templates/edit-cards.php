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
                <li class="breadcrumb-item"><a href="/login">Log In</a></li>
            </ol>
        </nav>
        <div class="row gy-3">
            <form method="post" class="row text-light text-center">
                <div class="col-12 mb-4">
                    <label>
                        <div class="fs-3">Title</div>
                        <small class="error-field">
                            <?= $titleError; ?>
                        </small>
                        <br>
                        <input type="text" name="edit-title" value="<?= $titleInput; ?>">
                    </label>
                </div>
                <div class="col-12 mb-4">
                    <label>
                        <div class="fs-3">Description</div>
                        <small class="error-field">
                            <?= $descriptionError; ?>
                        </small>
                        <br>
                        <input type="text" name="edit-desc" value="<?= $descriptionInput; ?>">
                    </label>
                </div>
                <div class="col-12 mb-4">
                    <label>
                        <div class="fs-3">Image</div>
                        <small class="error-field">
                            <?= $imageError; ?>
                        </small>
                        <br>
                        <input type="text" name="edit-img" value="<?= $imageInput; ?>">
                    </label>
                </div>
                <div class="col-12 mb-4">
                    <label>
                        <div class="fs-3">Category</div>
                        <small class="error-field">
                            <?= $categoryError; ?>
                        </small>
                        <br>
                        <input type="text" name="edit-category" value="<?= $categoryInput; ?>">
                    </label>
                </div>
                <label class="mb-5">
                    <input type="submit" name="edit-submit" value="Apply Changes">
                </label>
                <a href="home">Leave without saving</a>
            </form>
            <div class="error-field">
                <?= $mainErrorField; ?>
            </div>
        </div>

        <hr>
    </div>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>

</html>