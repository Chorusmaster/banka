<?php
    include "./parts/head.php";
    include_once (__DIR__ . "/classes/Messages.php");
    include_once "./parts/header.php";

    $messages = new Messages();
    $data = $messages->getMessages();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<main>
    <h2 id="qna_title">Otázky a odpovede</h2>
    <div id="container" class="qna_container">
        <?php
            $is_admin = ($_SESSION['account_id'] == $messages->getAdmin()["account_id"]);

            foreach ($data as $arr) {
                $type = $arr["sender_id"] == $_SESSION['account_id'] ? ' my_message' : ' answer_message';

                echo '<div class="message' . $type . '">';
                echo $arr["text"];

                echo '<div class="date">';

                if ($arr["sender_id"] == $_SESSION['account_id']) {
                    if($is_admin && $arr["receiver_id"] != $_SESSION['account_id']) {echo '<div class="to">To: ' . $messages->getUserName($arr["receiver_id"]) . '</div>'; }
                    echo '<a href="./forms/crud.php?action=update&id=' . $arr["message_id"] . '"><img class="update" alt="update button" src="./img/message_buttons/update.png"></a>';
                    echo '<a href="./forms/crud.php?action=delete&id=' . $arr["message_id"] . '"><img alt="delete button" src="./img/message_buttons/delete.png"></a>';
                } else {
                    if ($is_admin) {
                        echo '<div class="from">' . $messages->getUserName($arr["sender_id"]) . '</div>';
                        echo '<a href="qna.php?response=' . $arr["sender_id"] . '"><img alt="reply button" src="./img/message_buttons/reply.png"></a>';
                    }
                }

                $datetime = substr($arr["time"], 0, 10);
                if (date("Y-m-d") == $datetime) {$datetime = "Dnes " . substr($arr["time"], 10, 6); }

                echo ($datetime);
                echo '</div>';

                echo '</div>';
            }

            $text = (isset($_GET["update"])) ? 'value="' . $messages->getMessage($_GET["update"]) . '"' : '';
        ?>
        <div id="qna_form_div">
            <form method="post" action=<?php echo (isset($_GET["update"]) ? "./forms/crud.php" : "./forms/send_message.php"); ?>>
                <input type="text" name="text"<?php echo $text; ?> autocomplete="off" id="text_input" <?php if (!$data) {echo ' placeholder=" Napíš sem svojú prvú otázku"'; } ?>>
                <?php if (isset($_GET["update"])) echo ('<input type="text" style="display: none" value="' . $_GET["update"] . '" name="id">');?>
                <?php if (isset($_GET["response"])) echo ('<input type="text" style="display: none" value="' . $_GET["response"] . '" name="id">');?>
                <input type="image" src="./img/send_button.png" name="submit" id="send_input">
            </form>
        </div>
    </div>
</main>

<?php
include "./parts/footer.php";
?>