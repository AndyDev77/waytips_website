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

// fecth current user's posts from database
$current_user_id = $_SESSION['user-id'];

$query = "SELECT posts.id, posts.title, posts.category_id FROM posts JOIN users ON posts.author_id = users.id WHERE posts.author_id=$current_user_id ORDER BY posts.id DESC";

$posts = mysqli_query($connexion, $query);
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
            <h1 style="font-size: 4rem;">Tableau d'administration</h1>
        </div>
    </section>

    <section class="dashboard" style="margin-top: 170px;">
    <?php if (isset($_SESSION['add-post-success'])) : ?>
            <div class="alert__message success row justify-content-center" style="width: 60%; margin: 30px auto;">
                <p>
                    <?= $_SESSION['add-post-success'];
                    unset($_SESSION['add-post-success']);
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['edit-post-success'])) : ?>
            <div class="alert__message success row justify-content-center" style="width: 60%; margin: 30px auto;">
                <p>
                    <?= $_SESSION['edit-post-success'];
                    unset($_SESSION['edit-post-success']);
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['edit-post'])) : ?>
            <div class="alert__message error row justify-content-center" style="width: 60%; margin: 30px auto;">
                <p>
                    <?= $_SESSION['edit-post'];
                    unset($_SESSION['edit-post']);
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-post-success'])) : ?>
            <div class="alert__message error row justify-content-center" style="width: 60%; margin: 30px auto;">
                <p>
                    <?= $_SESSION['delete-post-success'];
                    unset($_SESSION['delete-post-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="fas fa-angle-right"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="fas fa-angle-left"></i></button>
            <aside>
                <ul>
                    <li><a href="add-post.php"><i class="fas fa-pen"></i>
                            <h5>Ajouter une actualité</h5>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php" class="active"><i class="fas fa-id-card-alt"></i>
                            <h5>Liste des actualités</h5>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['user_is_admin'])) : ?>
                        <li>
                            <a href="add-user.php"><i class="fas fa-user"></i>
                                <h5>Ajouter un utilisateur</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-users.php"><i class="fas fa-users"></i>
                                <h5>Liste des utilisateurs</h5>
                            </a>
                        </li>
                        <li>
                            <a href="add-category.php"><i class="fas fa-edit"></i>
                                <h5>Ajouter une catégorie</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-categories.php"><i class="fas fa-list-ul"></i>
                                <h5>Liste des catégories</h5>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main class="container table-responsive">
                <h2>Tableau de bord</h2>
                
                <?php if (mysqli_num_rows($posts) > 0) : ?>
                <table class="table table-bordered">
                    <thread>
                        <tr>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thread>
                    <tbody>
                    <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                        <?php 
                            $category_id = $post['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connexion, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                        ?>
                        <tr>
                            <td><?= $post['title'] ?></td>
                            <td><?= $category['title'] ?></td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn btn-success"><i class="fas fa-edit"></i></a></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>

                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert__message error row justify-content-center" style="width: 60%; margin: 30px auto;"><?= "Aucun posts " ?>
                    </div>
                <?php endif ?>
            </main>
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