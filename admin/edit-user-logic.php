<?php
require './config/database.php';

if (isset($_POST['submit'])) {
    // get updated form data

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $nom = filter_var($_POST['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // check for valid input
    if (!$nom || !$prenom) {
        $_SESSION['edit-user'] = 'Invalid Form input on edit page';

    } else {
        // update user
        $query = "UPDATE users SET nom='$nom', prenom='$prenom', is_admin=$is_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connexion, $query);

        if (mysqli_errno($connexion)) {
            $_SESSION['edit-user'] = "Failed to update user.";
        } else {
            $_SESSION['edit-user-success'] = "User $nom $prenom updated successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();