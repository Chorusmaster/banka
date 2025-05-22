<?php
include_once (dirname(__FILE__, 2) . "/classes/Messages.php");

$ms = new Messages();

if (isset($_GET["action"])) {

    $action = $_GET["action"];

    if ($action == "delete") {
        $ms->deleteMessage($_GET["id"]);
        header("Location: ../qna.php");
    } else if ($action == "update") {
        header("Location: ../qna.php?update=" . $_GET["id"]);
    }
} else {
    if (isset($_POST["text"])) {
        $ms->updateMessage($_POST["id"], $_POST["text"]);
    }

    header("Location: ../qna.php");
}