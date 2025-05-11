<?php
include_once(dirname(__FILE__, 2) . "/classes/Registration.php");

$reg = new Registration();
$reg->login(array($_POST["email"], $_POST["login"], $_POST["password"]));

header("Location: ../index.php");