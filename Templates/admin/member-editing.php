<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');
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
                    <div>* Search bar</div>
                    <br>
                    <label>
                        <input type="text" name="search-member" value="<?= $memberSearchBar; ?>">
                    </label>
                </div>
                <br><br><br><br>
                <div class="col-12">
                    <div>* Moderation action</div>
                    <small class="error-field">
                        <?= $moderationActionError; ?>
                    </small>
                    <br>
                    <label>
                        <input type="text" name="moderation-action" value="<?= $moderationActionInput; ?>">
                    </label>
                </div>
                <br><br><br><br>
                <div class="col-12">
                    <div>Email</div>
                    <div class="email-field">
                        <?= $userEmail; ?>
                    </div>
                </div>
                <br><br><br><br>
                <div class="col-12">
                    <div>* Delete user</div>
                    <small class="error-field">
                        <?= $deleteUserError; ?>
                    </small>
                    <div class="delete-user-field">
                        <button><?= $deleteUser; ?></button>
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
    <?php
    include_once('defaults/footer.php');

    ?>
</div>

</body>

</html>