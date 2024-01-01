<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
global $user;
global $userEmail;
global $userDeleteButton;
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
                <li class="breadcrumb-item"><a href="login">Log In</a></li>
            </ol>
        </nav>
        <div class="row gy-3">
            <form method="post" class="row text-light text-center">
                <div class="col-12">
                    <h3 class="mb-5">User information</h3>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col">
                            <h5><u>First name</u></h5>
                            <div class="fn-field">
                                <?= $user->first_name; ?>
                            </div>
                        </div>
                        <div class="col">
                            <h5><u>Last name</u></h5>
                            <div class="ln-field">
                                <?= $user->last_name; ?>
                            </div>
                        </div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col">
                            <h5 class="mt-5"><u>Email</u></h5>
                            <div class="email-field">
                                <?= $userEmail; ?>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="mt-5"><u>Role</u></h5>
                            <i class="role-field fw-bold">
                                <?= $user->role; ?>
                            </i>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
                <div class="col-12">
                    <h3 class="mt-5 pt-5">Moderation actions</h3>
                    <p class="text-decoration-underline mt-5">There are currently no special moderation actions.</p>
                    <br>
                </div>
                <br><br><br><br>
                <div class="col-12">
                    <h3 class="mt-5">Delete user</h3>
                    <small class="error-field">
                        <?= $deleteUserError; ?>
                    </small>
                    <div class="delete-user-field">
                        <?= $userDeleteButton; ?>
                    </div>
                </div>
                <br>
            </form>
            <div class="error-field">
                <?= $mainErrorField; ?>
            </div>
        </div>

        <hr>
    </div>
</div>

</body>

</html>