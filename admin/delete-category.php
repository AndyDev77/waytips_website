<?php
require './config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connexion, $query);
    $category = mysqli_fetch_assoc($result);

    // FOR LATER
    // fetch all thumbnails of user's posts and delete them
    $update_query = "UPDATE posts SET category_id=5 WHERE category_id=$id";
    $update_result = mysqli_query($connexion, $update_query);

    if (!mysqli_errno($connexion)) {
        // delete user from database
        $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($connexion, $query);
        $_SESSION['delete-category-success'] = "{$category['title']} supprimé avec succès";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
