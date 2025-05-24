<?php
include_once (dirname(__FILE__, 2) . "/classes/Operations.php");

try {
    $operations = new Operations();

    if ($_POST["amount"] >= 0) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $operations->changeAmount(-($_POST["amount"]));
        $operations->addNotation(($_POST["amount"]), $_SESSION["account_id"], null, $_POST["type"]);
        $operations->disconnect();
    }

    header("Location: ../index.php");
} catch (Exception $e) {

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION["error"] = $e->getMessage();

    header("Location: ../index.php");
}
