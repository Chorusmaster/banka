<?php
include_once (dirname(__FILE__, 2) . "/classes/Registration.php");

$reg = new Registration();
$reg->register(array($_POST["email"], $_POST["login"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["birth"]));

header("Location: ../index.php");