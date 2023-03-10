<?php
require './admin/config/constants.php';

// get back from data if there was a registration error

$nom = $_SESSION['signup-data']['nom'] ?? null;
$prenom = $_SESSION['signup-data']['prenom'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
// $avatar = $_SESSION['signup-data']['avatar'];
// delete signup data session
unset($_SESSION['signup-data']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Waytips</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/svg+xml">
    <!-- owl carousel css -->
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <!-- font awesome icons -->
    <link rel="stylesheet" href="./css/font-awesome.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#home"><img src="./images/logo-1.png" alt="" width="60"><img class="logo-purple"
                src="./images/logo.png" alt="" width="60"></a>

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
                    <a class="nav-link" href="#fonctions">Fonctionnalit??es</a>
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
                            <li><a href="<?= ROOT_URL ?>logout.php">D??connexion</a></li>
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
    <!-- <section class="img-background" style="background-image: url('./images/home/rehome.jpg');  
  background-size: cover; 
  height: 80vh; 
  min-height: 300px; 
  position: relative; 
  color: var(--white); 
  text-shadow: var(--shadow-black-100);">
        <div class="color-overlay d-flex justify-content-center align-items-center" style="position: absolute; 
  width: 100%;
  height: 100%; 
  background-color: rgba(0, 0, 0, 0.4);">
            <h1 style="font-size: 4rem;">Recherche de posts</h1>
        </div>
    </section> -->

    <section class="form__section-signup "  style="background-image: url('./images/home/rehome.jpg');  
  background-size: cover; 
  height: 100vh; 
  min-height: 300px; 
  position: relative; 
  color: var(--white); 
  text-shadow: var(--shadow-black-100);
  padding: 100px 0;">
        <div class="container form__section-container" style="background-color: rgba(0, 0, 0, 0.4); padding: 40px 80px; border-radius: 15px;">
            <h2>Inscrivez-Vous</h2>
            <br>
            <?php
            if (isset($_SESSION['signup'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signup'];
                            unset($_SESSION['signup']);
                        ?>
                    </p>
                </div>

            <?php endif ?>
            <form action="<?= ROOT_URL ?>signup-logic.php" class="form-sign" enctype="multipart/form-data" method="POST">
                <input type="text" name="nom" value="<?= $nom ?>" placeholder="Nom">
                <input type="text" name="prenom" value="<?= $prenom ?>" placeholder="Pr??nom">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Nom d'utilisateur">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Cr??e un mot de passe">
                <input type="password" name="confirmpassword"  value="<?= $confirmpassword ?>" placeholder="Confirme votre mot de passe">
                <div class="form__control">
                    <label for="avatar"></label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <br>
                <div class=" about-btn row justify-content-center">
                    <button type="submit" name="submit" class="btn btn-2" style="background-color: var(--color-1);
  padding: 1rem 2rem;
  color: var(--white);
  border-radius: 2px;
  font-size: 1rem;
  font-weight: 600;">Envoyer</button>
                </div>
                <br>
                <div class="row justify-content-center">
                    <small>Vous avez d??j?? un compte ? <a href="signin.php">Connectez-vous </a></small>
                </div>
            </form>
        </div>
    </section>

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup scroll-up">
        <i class="fa fa-arrow-up scrollup__icon" aria-hidden="true"></i>
    </a>


    <!-- jquery js -->
    <script src="js/jquery.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- owl carousel js -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- ScrollIt js -->
    <script src="js/scrollIt.min.js"></script>
    <!-- main js -->
    <script src="js/main.js"></script>
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