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
                <div class="col-12 mb-5">
                    <label>
                        <div class="fs-3">Title</div>
                        <small class="error-field">
                            <?= $titleError; ?>
                        </small>
                        <br>
                        <input type="text" name="login-fname" value="<?= $titleInput; ?>">
                    </label>
                </div>
                <div class="col-12 mb-5">
                    <label>
                        <div class="fs-3">Description</div>
                        <small class="error-field">
                            <?= $descriptionError; ?>
                        </small>
                        <br>
                        <input type="text" name="login-lname" value="<?= $descriptionInput; ?>">
                    </label>
                </div>
                <div class="col-12 mb-5">
                    <label>
                        <div class="fs-3">Image</div>
                        <small class="error-field">
                            <?= $imageError; ?>
                        </small>
                        <br>
                        <input type="text" name="login-email" value="<?= $imageInput; ?>">
                    </label>
                </div>
                <div class="col-12 mb-5">
                    <label>
                        <div class="fs-3">Category</div>
                        <small class="error-field">
                            <?= $categoryError; ?>
                        </small>
                        <br>
                        <input type="text" name="login-password" value="<?= $categoryInput; ?>">
                    </label>
                </div>
                <br>
                <label class="mb-5">
                    <input type="submit" name="login-submit" value="Save changes">
                </label>
                <a href="register">Don't have an account? Click here</a>
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