<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('defaults/head.php');

global $user;
global $email;

global $emailInput;
global $emailConfirmInput;
global $passwordInput;

global $emailError;
global $emailConfirmError;
global $passwordError;
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
                <li class="breadcrumb-item"><a href="login">Change email</a></li>
            </ol>
        </nav>
        <div class="row gy-3">
            <form method="post" class="text-light text-center">
                <div class="mb-5">
                    <h1>Change email request</h1>
                    <h2 class="fw-light">Welcome <?= $user->first_name; ?> <?= $user->last_name ?></h2>
                </div>
                <div class="mb-5">
                    <h5>Current email</h5>
                    <p>
                        <?= $email; ?>
                    </p>
                </div>
                <div class="row mb-3">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <label for="exampleInputEmail1" class="form-label fw-bold fs-5">New email</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="new-email" value="<?= $emailInput; ?>">
                        <div class="error-field">
                            <?= $emailError; ?>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row mb-5">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <label for="exampleInputEmail1" class="form-label fw-bold fs-5">Confirm new email</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="new-email-confirm" value="<?= $emailConfirmInput; ?>">
                        <div class="error-field">
                            <?= $emailConfirmError; ?>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row mb-5">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <label for="exampleInputEmail1" class="form-label fw-bold fs-5">Current password</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="current-password" value="<?= $passwordInput; ?>">
                        <div class="error-field">
                            <?= $passwordError; ?>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
                <input type="submit" class="btn btn-light" name="submit-email-change" value="Submit email change">
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