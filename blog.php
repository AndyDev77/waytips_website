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

$queryPosts = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 6";
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

    <!--HOME-->
    <section id="home" class="home" id="home">
        <div class="container d-flex justify-content-around align-items-center">
            <div class="row justify-content-center">
                <div class="home-text">
                    <h1 class="text-center">Blog</h1>
                    <br>
                    <p class="text-center">Découvrez nos posts et nos actualités du moments !</p>
                    <p class="text-center">Ne manquer aucunes de nos actualités !</p>
                    <div class="home-btn text-center">
                        <a href="#circuit" class="btn btn-1 "><i class="fas fa-arrow-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--HOME END-->

    <!--SEARCH-->
    <section class="search__bar section-padding">
        <form class="container search__bar-container" action="<?= ROOT_URL ?>search.php" method="GET">
            <div>
                <i class="fa fa-search"></i>
                <input type="search" id="search" class="serach" name="search" placeholder="Recherche" />
            </div>
            <button type="submit" name="submit" class="btn-search">Go</button>
        </form>
    </section>

    <?php if (mysqli_num_rows($featured_result) == 1) : ?>
        <section class="featured">
            <div class="container featured__container">
                <div class="post__thumbnail">
                    <img src="./images/<?= $featured['thumbnail'] ?>" alt="images-actualite">
                </div>
                <div class="post__info">
                    <?php
                    //fetch category from categories table using category_id of post
                    $category_id = $featured['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id= $category_id";
                    $category_result = mysqli_query($connexion, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    $category_title = $category['title'];

                    ?>
                    <a href="" class="category__button"><?= $category['title'] ?></a>
                    <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                    <p class="post__body">
                        <?= substr($featured['body'], 0, 300) ?>...
                    </p>
                    <div class="post__author">
                        <div class="post__author-info">

                            <small><?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>

    <br><br>
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