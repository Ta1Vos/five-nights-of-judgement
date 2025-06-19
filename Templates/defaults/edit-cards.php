<!DOCTYPE html>
<html>
<?php
// Adds the head for the page.
include_once('head.php');
global $params;
?>

<body>

<div class="container bg-dark">
    <?php
    //adds the rest of the default files.
    include_once('header.php');
    include_once('../Templates/admin/defaults/menu.php');
    //    include_once('defaults/pictures.php');
    ?>

    <div class="bg-black text-light text-center p-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="/<?= $params[1] ?>/edit/<?= $params[3] ?>/<?= $params[4] ?>">Admin - Editing</a></li>
            </ol>
        </nav>
        <div class="row gy-3 text-center">