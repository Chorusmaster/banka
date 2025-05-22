<?php
include_once (dirname(__FILE__, 2) . "/classes/Messages.php");

$ms = new Messages();

if (isset($_POST["id"])) {
    $ms->addMessage($_POST["text"], $_POST["id"]);
} else {
    $ms->addMessage($_POST["text"]);
}

header("Location: ../qna.php");