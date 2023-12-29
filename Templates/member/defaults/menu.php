<?php
$firstLinkPiece = loadLinkContent();
global $additionalNavbarContent;

if (!isset($firstLinkPiece)) {
    $firstLinkPiece = null;
}

if (!isset($additionalNavbarContent)) {
    $additionalNavbarContent = null;
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid row text-center">
        <a class="col navbar-brand p-0 pe-lg-5" href="<?= $firstLinkPiece;?>home">
            <img src="/img/fnoj_logo.jpg" class="navbar-logo" alt="Logo image">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-8 collapse navbar-collapse" id="myNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $firstLinkPiece;?>home">home</a>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu dropdown-hover-content bg-dark text-light text-center">
                        <li class="nav-item"><a class="nav-link text-white" href="<?= $firstLinkPiece;?>categories">All Categories</a></li>
                        <?php if (!empty($navbarCategoryContent)) {
                            echo $navbarCategoryContent;
                        }; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $firstLinkPiece;?>contact">contact</a>
                </li>
                <?= $additionalNavbarContent; ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $firstLinkPiece;?>logout">log out</a>
                </li>
            </ul>
        </div>
        <a class="col navbar-brand p-0 ps-lg-5 text-right" href="<?= $firstLinkPiece;?>home">
            <img src="/img/fnoj_logo.jpg" class="navbar-logo d-none d-lg-block" alt="Logo">
        </a>
    </div>
</nav>