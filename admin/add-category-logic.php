<?php

require './config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$title) {
        $_SESSION['add-category'] = "Entrer le titre !";
    } elseif (!$description) {
        $_SESSION['add-category'] = "Entrer la description !";
    }

    if (isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    } else {
        // insert new user into users table
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connexion, $query);

        if (mysqli_errno($connexion)) {
            // redirect to login page with success message
            $_SESSION['add-category'] = "Impossible d'avoir une catégorie !";
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        } else {
            $_SESSION['add-category-success'] = "La catégorie $title a été ajoutée avec succès !";
            header('location: ' . ROOT_URL . 'admin/manage-categories.php');
            die();
        }
    }
}
