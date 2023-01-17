<?php
require './config/database.php';

if (isset($_POST['submit'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    $is_featured = $is_featured == 1 ?: 0;

    //check and validate input values

    if (!$title) {
        $_SESSION['edit-post'] = "Entrer un titre !";
    } elseif (!$category_id) {
        $_SESSION['edit-post'] = "Sélectionner votre catégorie !";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Entrer votre contenu !";
    } else {
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {
                unlink($previous_thumbnail_path);
            }

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
                if ($thumbnail['size'] < 2000000) {

                    //upload thumbnail
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {

                    $_SESSION['edit-post'] = "File update size too big . Should be less than 2mb";
                }
            } else {

                $_SESSION['edit-post'] = "File update should be png, jpg, or jpeg";
            }
        }
    }

    // redirect back with form data to add-post page if there was any problem
    if (isset($_SESSION['edit-post'])) {

        header('location: ' . ROOT_URL . 'admin/edit-post.php');
        die();
    } else {
        // set is_featured of all posts to 0 if is featured for this post is 1
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0 ";
            $zero_all_is_featured_result = mysqli_query($connexion,  $zero_all_is_featured_query);
        }

        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        // insert post into database
        $query = "UPDATE posts SET title='$title', body='$body',thumbnail='$thumbnail_to_insert',category_id=$category_id, is_featured= $is_featured WHERE id=$id LIMIT 1";
        $result = mysqli_query($connexion, $query);
    }


    if (!mysqli_errno($connexion)) {
        // redirect to login page with success message
        $_SESSION['edit-post-success'] = "Post updated successfully.";
        header('location: ' . ROOT_URL . 'admin/dashboard.php');
        die();
    }
}


