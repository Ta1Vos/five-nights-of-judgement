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
        include_once(loadCorrectIncludeFormat('defaults/menu.php'));
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
                        <div>* First name</div>
                        <small class="error-field">
                            <?= $firstNameError; ?>
                        </small>
                        <br>
                        <label>
                            <input type="text" name="reg-fname" value="<?= $firstName; ?>">
                        </label>
                    </div>
                    <br><br><br><br>
                    <div class="col-12">
                        <div>* Last name</div>
                        <small class="error-field">
                            <?= $lastNameError; ?>
                        </small>
                        <br>
                        <label>
                            <input type="text" name="reg-lname" value="<?= $lastName; ?>">
                        </label>
                    </div>
                    <br><br><br><br>
                    <div class="col-12">
                        <div>Email</div>
                        <small class="error-field">
                            <?= $emailError; ?>
                        </small>
                        <br>
                        <label>
                            <input type="text" name="reg-email" value="<?= $email; ?>">
                        </label>
                    </div>
                    <br><br><br><br>
                    <div class="col-12">
                        <div>* Password</div>
                        <small class="error-field">
                            <?= $passwordError; ?>
                        </small>
                        <br>
                        <label>
                            <input type="text" name="reg-password" value="<?= $password; ?>">
                        </label>
                    </div>
                    <br><br><br><br>
                    <div class="col-12">
                        <div>* Confirm Password</div>
                        <small class="error-field">
                            <?= $passwordConfirmError; ?>
                        </small>
                        <br>
                        <label>
                            <input type="text" name="reg-password-confirm" value="<?= $passwordConfirm; ?>">
                        </label>
                    </div>
                    <div class="explanation">
                        * = mandatory
                    </div>
                    <br>
                    <label>
                        <input type="submit" name="reg-submit" value="Register">
                    </label>
                    <a href="login">Already have an account? Click here</a>
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