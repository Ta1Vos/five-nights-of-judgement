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
                    <li class="breadcrumb-item"><a href="/register">Register</a></li>
                </ol>
            </nav>
            <div class="row gy-3">
                <form method="post" class="row text-light text-center">
                    <div class="col-12">
                        <label><small>* First name</small><br>
                            <input type="text" name="reg-fname" value="<?= $firstName; ?>">
                            <div class="error-field">
                                <?= $firstNameError; ?>
                            </div>
                        </label>
                    </div>
                    <br><br>
                    <div class="col-12">
                        <label><small>Last name</small><br>
                            <input type="text" name="reg-lname" value="<?= $lastName; ?>">
                            <div class="error-field">
                                <?= $lastNameError; ?>
                            </div>
                        </label>
                        <label><small>Email</small><br>
                            <input type="text" name="reg-email" value="<?= $email; ?>">
                            <div class="error-field">
                                <?= $emailError; ?>
                            </div>
                        </label>
                    </div>
                    <br><br>
                    <div class="col-12">
                        <label><small>* Password</small><br>
                            <input type="text" name="reg-password" value="<?= $password; ?>">
                            <div class="error-field">
                                <?= $passwordError; ?>
                            </div>
                        </label>
                        <label><small>* Confirm Password</small><br>
                            <input type="text" name="reg-password-confirm" value="<?= $passwordConfirm; ?>">
                            <div class="error-field">
                                <?= $passwordConfirmError; ?>
                            </div>
                        </label>
                    </div>
                    <div class="explanation">
                        * = mandatory
                    </div>
                    <br>
                    <label>
                        <input type="submit" name="reg-submit" value="Register">
                    </label>
                </form>
                <div class="error-field text-light">
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