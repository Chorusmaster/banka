<?php
include_once(dirname(__FILE__, 2) . "/classes/Registration.php");

try {
    $reg = new Registration();
    $reg->login(array($_POST["email"], $_POST["login"], $_POST["password"]));

    header("Location: ../index.php");
} catch(Exception $e){

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION["error"] = $e->getMessage();

    header("Location: ../registration.php");
}