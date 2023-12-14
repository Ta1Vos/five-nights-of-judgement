<?php
global $titleInput;
global $descriptionInput;
global $imageInput;
global $categoryInput;
?>

<form method="post" class="row text-light text-center">
    <div class="col-12 mb-5">
        <div class="fs-3">Title</div>
        <small class="error-field">
            <?= $titleError; ?>
        </small>
        <br>
        <label>
            <input type="text" name="edit-title" value="<?= $titleInput; ?>">
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
                                    <textarea class="form-control" name="edit-desc"
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
                                    <textarea class="form-control" name="edit-img"
                                    ><?= $imageInput; ?></textarea>
                </label>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <div class="col-12 mb-5">
        <div class="fs-3">Category</div>
        <small class="error-field">
            <?= $categoryError; ?>
        </small>
        <br>
        <label>
            <input type="text" name="edit-category" value="<?= $categoryInput; ?>">
        </label>
    </div>
    <br>
    <label class="mb-3">
        <input type="submit" name="edit-product-submit" value="Save changes">
    </label>
    <div class="error-field mb-3">
        <?= $mainErrorField; ?>
    </div>
    <a href="/admin/home">Leave <b>without</b> saving</a>
</form>