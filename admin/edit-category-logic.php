<?php
require './config/database.php';

if (isset($_POST['submit'])) {
    // get updated form data

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // check for valid input
    if (!$title || !$description) {
        $_SESSION['edit-category'] = "Formulaire d'entrée invalide sur la page d'édition de la catégorie";

    } else {
        // update categories
        $query = "UPDATE categories SET title='$title', description='$description' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connexion, $query);

        if (mysqli_errno($connexion)) {
            $_SESSION['edit-category'] = "Échec de la mise à jour de la catégorie.";
        } else {
            $_SESSION['edit-category-success'] = "$title mise à jour avec succès";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();