<?php
include_once (dirname(__FILE__, 2) . "/classes/Operations.php");

$operations = new Operations();
$operations->transfer($_POST["amount"], $_POST["to"]);

header("Location: ../index.php");