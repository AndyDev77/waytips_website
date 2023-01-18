<?php
require './admin/config/database.php';

// fetch current user from database
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id ";
    $result = mysqli_query($connexion, $query);
    $avatar = mysqli_fetch_assoc($result);
}

//fetch featured post from database
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connexion, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);



// fetch 6 posts from posts table

$queryPosts = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 3";
$posts = mysqli_query($connexion, $queryPosts);


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

            </ul>
        </div>
        <!-- Brand -->



    </nav>

    <!--HOME-->
    <section id="home" class="home" id="home">
        <div class="container d-flex justify-content-around align-items-center">
            <div class="row justify-content-center">
                <div class="home-text">
                    <h1 class="text-center">WayTips</h1>
                    <br>
                    <p class="text-center">Tu as déjà passé des heures à organiser ton séjour ?</p>
                    <p class="text-center">Manquer des évènements par manque d'informations ?</p>
                    <div class="home-btn text-center">
                        <a href="#circuit" class="btn btn-1 ">Organise ton circuit</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--HOME END-->

    <!--ABOUT-->
    <section class="about d-flex justify-content-center align-items-center" id="about">
        <div class="container d-flex flex-wrap justify-content-around align-items-center">
            <img src="./images/about/Sans.png" alt="">
            <div class="about-text">
                <h3>À propos</h3>
                <h2>Road Trip ou petit voyage,</h2>
                <p>WayTips te propose des circuits sur-mesure, adaptés à tes envies, ton budget et prend en compte les
                    festivités locales. Nous te proposons une expérience unique et hyper-personnalisée.
                    Partage-nous les dates de ton séjour et nous t'aiderons à créer ta propre aventure. Tu
                    recevras sous 24 heures ton circuit sur mesure !</p>
                <div class="about-btn">
                    <a href="#faq" class="btn btn-2">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>
    <!--ABOUT END-->

    <!--SERVICES-->
    <section class="services section-padding" id="services">
        <div class="container">
            <div class="row justify-content-center">
                <div>
                    <div class="section-title">
                        <h3>Nos Services</h3>
                        <h2>Nos thèmes proposés</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="items">
                        <span class="icon feature_box_col">
                            <i class="fas fa-trailer"></i>
                        </span>
                        <h6>Attraction</h6>
                        <p>Lieu ou spectacle, notamment le spectacle de rue, les expositions, les manèges ou les
                            montagnes russes.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="items">
                        <span class="icon feature_box_col">
                            <i class="fas fa-running"></i>
                        </span>
                        <h6>Sport</h6>
                        <p>Plusieurs activités physiques exercées dans le sens du jeu et de l'effort sont proposées.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="items">
                        <span class="icon feature_box_col">
                            <i class="fas fa-book-reader"></i>
                        </span>
                        <h6>Détente</h6>
                        <p>Des moments de détente et de bien-être pour un repos bien mérité.</p>
                        <br>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="items">
                        <span class="icon feature_box_col">
                            <i class="fas fa-users"></i>
                        </span>
                        <h6>Famille</h6>
                        <p>Les vacances en famille sont l’occasion de se retrouver tous ensemble, de se ressourcer et de
                            profiter de ses enfants.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="items">
                        <span class="icon feature_box_col">
                            <i class="fas fa-landmark"></i>
                        </span>
                        <h6>Musée</h6>
                        <p>Découvrir de manière ludique le patrimoine en lien direct avec la thématique de la visite .
                        </p>
                        <br>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="items">
                        <span class="icon feature_box_col">
                            <i class="fas fa-archway"></i>
                        </span>
                        <h6>Monument</h6>
                        <p>Aux quatre coins du monde, se trouvent des monuments incroyables, de rêve, dont certains sont
                            méconnus par la plupart des gens.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SERVICES END-->

    <!--Fonctionnalités-->
    <section class="work section-padding" id="fonctions">
        <div class="container">
            <div class="row justify-content-center">
                <div>
                    <div class="section-title">
                        <h3>Fonctionnalités</h3>
                        <h2>Comment ça fonctionne ?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-center m-auto">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item carousel-item active">
                                <div class="img-box"><img src="./images/work-1.png" alt=""></div>
                                <h4>Télécharger l'application</h4>
                                <p class="work-steps">L'application sera disponible prochainement sur Google Play.</p>
                            </div>
                            <div class="item carousel-item ">
                                <div class="img-box"><img src="./images/work-2.png" alt=""></div>
                                <h4>Choisis tes centres d'intérêts</h4>
                                <p class="work-steps">Choisissez parmis nos propositions que l'on vous propose vos
                                    thèmes préférés .</p>
                            </div>
                            <div class="item carousel-item ">
                                <div class="img-box"><img src="./images/work-3.png" alt=""></div>
                                <h4>Paramètre ton voyage</h4>
                                <p class="work-steps">Mets ta destination, tes dates, le nombre de personnes présentes
                                    puis ton budget.</p>
                            </div>
                            <div class="item carousel-item ">
                                <div class="img-box"><img src="./images/work-4.png" alt=""></div>
                                <h4>Obtiens ton circuit</h4>
                                <p class="work-steps">Sur une map sur-mesure avec la liste de vos actualités que WayTips
                                    va vous proposez.</p>
                            </div>

                        </div>
                        <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!--Fonctionnalités END-->

    <section class="blog section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div>
                    <div class="section-title">
                        <h3>Blog</h3>
                        <h2>Nos articles du moments</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <section class="posts">
                    <div class="container posts__container">
                        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <article class="post">
                                <div class="post__thumbnail">
                                    <img src="./images/<?= $post['thumbnail'] ?>" alt="">
                                </div>
                                <div class="post__info">
                                    <?php
                                    //fetch category from categories table using category_id of post
                                    $category_id = $post['category_id'];
                                    $category_query = "SELECT * FROM categories WHERE id= $category_id";
                                    $category_result = mysqli_query($connexion, $category_query);
                                    $category = mysqli_fetch_assoc($category_result);
                                    $category_title = $category['title'];

                                    ?>
                                    <a href="#" class="category__button"><?= $category['title'] ?></a>
                                    <h3> <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                                    </h3>
                                    <p class="post__body">
                                        <?= substr($post['body'], 0, 200) ?>...
                                    </p>
                                    <div class="post__author">
                                        <div class="post__author-info">

                                            <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile ?>
                    </div>
                    </section>
                    <div class="about-btn">
                        <a href="blog.php" class="btn btn-2">Voir notre blog</a>
                    </div>
                </section>
            </div>
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