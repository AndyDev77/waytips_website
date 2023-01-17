<?php
require './config/database.php';
// fetch current user from database
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id ";
    $result = mysqli_query($connexion, $query);
    $avatar = mysqli_fetch_assoc($result);
}

//check login status
if (!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'signin.php');
}

// get back form data if there was an error
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Waytips</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/svg+xml">
    <!-- owl carousel css -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <!-- font awesome icons -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#home"><img src="../images/logo-1.png" alt="" width="60"><img class="logo-purple"
                src="../images/logo.png" alt="" width="60"></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"
            style="margin: 0 70px;">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#fonctions">Fonctionnalitées</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#prix">Prix</a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="blog.php">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#circuit">Circuit</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <?php if (isset($_SESSION['user-id'])) : ?>
                    <li class="nav__profile nav-item">
                        <div class="avatar">
                            <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>">
                        </div>
                        <ul>
                            <li><a href="<?= ROOT_URL ?>admin/dashboard.php">Dashboard</a></li>
                            <li><a href="<?= ROOT_URL ?>logout.php">Déconnexion</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT_URL ?>signin.php">Connexion</a>
                    </li>
                <?php endif ?>

            </ul>
        </div>
        <!-- Brand -->



    </nav>

    <!--ImageBackground-->
    <section class="img-background">
        <div class="color-overlay d-flex justify-content-center align-items-center">
            <h1 style="font-size: 4rem;">Ajouter une catégorie</h1>
        </div>
    </section>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Ajouter une categorie</h2>
            <?php if(isset($_SESSION['add-category'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-category'];
                        unset($_SESSION['add-category']); 
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-category-logic.php" class="form-sign" method="POST">
                <input type="text" name="title" value="<?= $title ?>" placeholder="Titre">
                <textarea rows="4" name="description" value="<?= $description ?>" placeholder="Description"></textarea>
                <div class="about-btn row justify-content-center">
                    <button type="submit" name="submit" class="btn btn-2">Ajouter une catégorie</button>
                </div>
            </form>
        </div>
    </section>
    
    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup scroll-up">
        <i class="fa fa-arrow-up scrollup__icon" aria-hidden="true"></i>
    </a>


    <!-- jquery js -->
    <script src="../js/jquery.min.js"></script>
    <!-- popper js -->
    <script src="../js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- owl carousel js -->
    <script src="../js/owl.carousel.min.js"></script>
    <!-- ScrollIt js -->
    <script src="../js/scrollIt.min.js"></script>
    <!-- main js -->
    <script src="../js/main.js"></script>
    <script>
        $(document).ready(function () {
            $(window).bind("scroll", function () {
                let gap = 80;
                if ($(window).scrollTop() > gap) {
                    $("nav").addClass("active");
                    $(".logo-purple").addClass("active");
                } else {
                    $("nav").removeClass("active");
                    $(".logo-purple").removeClass("active");
                }
            })
        })
    </script>
</body>

</html>