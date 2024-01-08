<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('defaults/head.php');

global $user;

global $oldPasswordInput;
global $passwordInput;
global $passwordConfirmInput;

global $oldPasswordError;
global $passwordError;
global $passwordConfirmError;
global $mainErrorField;
//global $password;
//global $passwordInputType;
?>

<body>

<div class="container bg-dark">
    <?php
    //adds the rest of the default files.
    include_once('defaults/header.php');
    include_once(loadCorrectIncludeFormat('defaults/menu.php'));
    //    include_once('defaults/pictures.php');
    ?>

    <div class="bg-black text-light text-center p-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="login">Change password</a></li>
            </ol>
        </nav>
        <div class="row gy-3">
            <form method="post" class="text-light text-center">
                <div class="mb-5">
                    <h1>Reset password request</h1>
                    <h2 class="fw-light">Welcome <?= $user->first_name; ?> <?= $user->last_name ?></h2>
                </div>
                <div class="row mb-5">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <label for="InputPassword1" class="form-label fw-bold fs-5">Old password</label>
                        <input type="text" class="form-control" id="InputPassword1" aria-describedby="emailHelp" name="old-password" value="<?= $oldPasswordInput; ?>">
                        <div class="error-field">
                            <?= $oldPasswordError; ?>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <label for="InputEmail1" class="form-label fw-bold fs-5">New password</label>
                        <input type="text" class="form-control" id="InputEmail1" aria-describedby="emailHelp" name="new-password" value="<?= $passwordInput; ?>">
                        <div class="error-field">
                            <?= $passwordError; ?>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row mb-5">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <label for="InputEmail2" class="form-label fw-bold fs-5">Confirm new password</label>
                        <input type="text" class="form-control" id="InputEmail2" aria-describedby="emailHelp" name="new-password-confirm" value="<?= $passwordConfirmInput; ?>">
                        <div class="error-field">
                            <?= $passwordConfirmError; ?>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
                <input type="submit" class="btn btn-light" name="submit-password-change" value="Submit password change">
            </form>
            <div class="main-error-field error-field">
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