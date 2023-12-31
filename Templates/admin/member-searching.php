<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('../Templates/defaults/head.php');

global $memberList;
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
                <li class="breadcrumb-item"><a href="member-editing">Search members</a></li>
            </ol>
        </nav>
        <div class="row gy-3">
            <form method="post" class="row text-light text-center mt-2">
                <div class="col-12">
                    <h3>Search by name</h3>
                    <div>First name</div>
                    <br>
                    <label>
                        <input type="text" name="search-member-fn" value="<?= $memberSearchBar; ?>">
                    </label>
                    <div class="pt-3">Last name</div>
                    <br>
                    <label>
                        <input type="text" name="search-member-ln" value="<?= $memberSearchBar; ?>">
                    </label>
                    <br>
                    <div class="searches p t-3">
                        <label>
                            <input type="submit" name="submit-member-search" value="Search">
                        </label>
                        <br>
                        <label class="mt-5">
                            <input type="submit" name="submit-member-search" value="Select all members">
                        </label>
                    </div>
                    <br><hr><br>
                    <h3>Found users in list</h3>
                    <label>
                        <select name="selected-member">
                            <?php
                            //LIST THE IMAGES OF THE PRODUCTS OF THE CATEGORIES
                            foreach ($memberList as $member) {
                                echo "<option value='$member->id'>$member->id - $member->first_name $member->last_name</option>";
                            } ?>
                        </select>
                    </label>
                </div>
                <label class="mt-5">
                    <input type="submit" name="select-member" value="Select member">
                </label>
            </form>
            <div class="error-field">
                <?= $mainErrorField; ?>
            </div>

            <hr>
        </div>

</body>

</html>