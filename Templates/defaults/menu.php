<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand pe-5" href="/home">
            FNOJ
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu dropdown-hover-content bg-dark text-light">
                        <?php if (!empty($navbarCategoryContent)) {echo $navbarCategoryContent;}; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="/register">registreren</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/login">inloggen</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand ps-5" href="/home">
            FNOJ
        </a>
    </div>
</nav>