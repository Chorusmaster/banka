<?php
    session_start();
    $page_name = basename(explode("?", $_SERVER['REQUEST_URI'])[0], ".php");
    if (($page_name != "registration") && (!isset($_SESSION["account_id"]))) {
        header("Location: registration.php?type=register");
    }
?>

<!doctype html>
<html lang=sk>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'> <!--font-->

    <?php
        include_once "php/structure_functions.php";
        echo "<link rel='stylesheet' type='text/css' href='css/general_styles.css'>";

        validatePagename(true);
    ?>
    <link rel="stylesheet" type="text/css" href="css/general_styles.css">
    <link rel="stylesheet" type="text/css" href="css/index_styles.css">

    <title>Žbanka</title>
</head>
