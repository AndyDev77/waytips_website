<?php
require 'constants.php';


//Connexion à la bdd

$connexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_errno($connexion)) {
    die(mysqli_error($connexion));
}