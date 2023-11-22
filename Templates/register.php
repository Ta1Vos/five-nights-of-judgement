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
            <form method="post">
                <input type="text" name="reg-fname"><br>
                <input type="text" name="reg-lname"><br>
                <input type="text" name="reg-email"><br>
                <input type="text" name="reg-password"><br>
                <input type="submit">
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

