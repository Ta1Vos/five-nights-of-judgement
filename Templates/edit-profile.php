<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('defaults/head.php');

global $user;
global $email;
global $password;
global $passwordInputType;
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
                <li class="breadcrumb-item"><a href="login">Edit profile</a></li>
            </ol>
        </nav>
        <div class="row gy-3">
            <form method="post" class="row text-light text-center">
                <div class="col-12 mb-5">
                    <h1>Profile editing</h1>
                    <h2 class="fw-light">Welcome <?= $user->first_name; ?> <?= $user->last_name ?></h2>
                </div>
                <div class="col-4">
                    <h5>Current email</h5>
                    <p>
                        <?= $email; ?>
                    </p>
                    <a href="change-email" class="btn btn-light">Change email</a>
                </div>
                <div class="col-4">
                    <h5>Current password</h5>
                    <label>
                        <input type="<?= $passwordInputType; ?>" value="<?= $password; ?>" disabled>
                    </label>
                    <br>
                    <label>
                        <input type="submit" name="toggle-password" value="toggle password visibility" class="btn btn-light mt-2">
                    </label>
                    <br>
                    <label>
                        <a href="change-password" class="btn btn-light mt-2">Reset password</a>
                    </label>
                </div>
            </form>
        </div>

        <hr>
    </div>
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>

</html>