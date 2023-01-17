<?php
session_start();
require './admin/config/database.php';

//get signup from data if sugnup button was clicked

if (isset($_POST['submit'])) {
    $nom = filter_var($_POST['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    // valid input values 
    if (!$nom) {
        $_SESSION['signup'] = "Entrer votre nom !";
    } elseif (!$prenom) {
        $_SESSION['signup'] = "Entrer votre prénom !";
    } elseif (!$username) {
        $_SESSION['signup'] = "Entrer votre nom d'utilisateur !";
    } elseif (!$email) {
        $_SESSION['signup'] = "Entrer un email valide !";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Entrer un mot de passe ayant 8 caractères ou plus !";
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Ajouter un avatar !";
    } else {
        // check if passwords don't match

        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Le mot de passe ne correspond pas";
        } else {
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //check if username or email already exist in database
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connexion, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Le nom d'utilisateur ou l'adresse électronique existent déjà";
            } else {
                // Work on AVATAR
                //rename avatar
                $time = time(); //make each image name unique using timestamp
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // make sure files is an images
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_files)) {
                    // make sure image is not too large (1mb+)
                    if ($avatar['size'] < 10000000) {
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['signup'] = "La taille du fichier est trop importante. Il devrait être inférieur à 1 Mo.";
                    }
                } else {
                    $_SESSION['signup'] = "Le fichier doit être png, jpg ou jpeg.";
                }
            }
        }
    }

    // redirect back to signup pag eif there was any problem
    if (isset($_SESSION['signup'])) {
        // pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        // insert new user into users table
        $insert_user_query = "INSERT INTO users (nom, prenom, username, email, password, avatar, is_admin) VALUES('$nom','$prenom','$username','$email', '$hashed_password', '$avatar_name', 0)";
        $insert_suer_result = mysqli_query($connexion, $insert_user_query);

        if (!mysqli_errno($connexion)) {
            // redirect to login page with success message
            $_SESSION['signup-success'] = "Inscription réussie. Veuillez vous connecter !";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {
    // if button wasn't clicked, back to signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
