<?php
require './config/database.php';

if (isset($_POST['submit'])) {
    $author_id =  $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 if unchecked

    $is_featured = $is_featured == 1 ?: 0;

    // validate form data

    if (!$title) {
        $_SESSION['add-post'] = "Entrer un titre !";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Sélectionner votre catégorie !";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Entrer votre contenu !";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choisir la vignette de l'article !";
    } else {
        // Work on thumbnail
        // rename the image
        $time = time(); //make each image name unique using timestamp
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        // make sure files is an images
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $thumbnail_name);
        $extention = end($extention);
        if (in_array($extention, $allowed_files)) {
            // make sure image is not too large (2mb+)
            if ($thumbnail['size'] < 3000000) {

                //upload thumbnail
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {

                $_SESSION['add-post'] = "La taille du fichier est trop importante. Il devrait être inférieur à 3 Mo.";
            }
        } else {

            $_SESSION['add-post'] = "Le fichier doit être png, jpg ou jpeg.";
        }
    }

    // redirect back with form data to add-post page if there was any problem
    if (isset($_SESSION['add-post'])) {

        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {
        // set is_featured of all posts to 0 if is featured for this post is 1
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0 ";
            $zero_all_is_featured_result = mysqli_query($connexion,  $zero_all_is_featured_query);
        }

        // insert post into database
        $query = "INSERT INTO posts SET title='$title', body='$body',thumbnail='$thumbnail_name',category_id=$category_id, author_id=$author_id, is_featured= $is_featured";
        $result = mysqli_query($connexion, $query);

        if (!mysqli_errno($connexion)) {
            // redirect to login page with success message
            $_SESSION['add-post-success'] = "Nouveau post ajouté avec succès.";
            header('location: ' . ROOT_URL . 'admin/dashboard.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add-post.php');
    die();

}

