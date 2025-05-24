<?php
function validatePagename($getCSS=false) {
    $page_name = basename(explode("?", $_SERVER['REQUEST_URI'])[0], ".php");
    if ($page_name == "banka") $page_name = "index";

    $page_data = json_decode(file_get_contents("data/pages_register.json"), true);
    $page_keys = array_keys($page_data);
    $isValid = false;
    foreach ($page_keys as $key) {
        if ($key == $page_name) {
            $isValid = true;
            if ($getCSS) {
                for($i = 0; $i < count($page_data[$key]["css"]); $i++) {
                    echo  "<link rel='stylesheet' type='text/css' href='".$page_data[$key]["css"][$i]."'>";
                }
            }
            else return $page_name;
        }
    }

    if (!$isValid) return "none";
}

function printNavBar()
{
    $page_data = json_decode(file_get_contents("data/pages_register.json"), true);
    $page_keys = array_keys($page_data);

    if (($page_name = validatePagename()) !== "none" && $page_name !== "registration") {
        echo "<a href = 'index.php'><img id='nav_logo' src='./img/logo.png' alt='logotyp'></a>";
        foreach ($page_keys as $key) {
            if ($key != "registration") {
                if ($key == $page_name) echo "<a class='chosen' href = '" . $key . '.php' . "'>" . $page_data[$key]["nav_name"] . "</a></li>";
                else echo "<a href = " . $key . '.php' . ">" . $page_data[$key]["nav_name"] . "</a></li>";
            }
        }
        echo "<a href = './php/logout.php'>" . "ODHLÁSENIE" . "</a></li>";

    } else if ($page_name === "registration") {
        $is_register = isset($_GET["type"]) && $_GET["type"] == "register" ? "class='chosen'" : "";
        $is_login = isset($_GET["type"]) && $_GET["type"] == "login" ? "class='chosen'" : "";

        echo "<a href = './registration.php?type=register'><img id='nav_logo' src='./img/logo.png' alt='logotyp'></a>";
        echo "<a " . $is_register . " href = './registration.php?type=register'>" . "REGISTRÁCIA" . "</a></li>";
        echo "<a id='low_padding' " . $is_login . " href = './registration.php?type=login'>" . "PRIHLÁSENIE" . "</a></li>";
    }
}

function printServices() {
    $services_data = json_decode(file_get_contents("data/services_register.json"), true);

    foreach ($services_data as $service) {
        echo '<div>
                    <img class="offer" src="' . $service["img"] . '">
                    <div class="offer_name">' . $service["name"] . '</div>
                    <div class="offer_description">' . $service["description"] . '</div>
                    <div class="offer_payment">
                        <form method="post" action="./forms/servise.php">
                            <input type="text" name="amount" style="display: none" value="' . $service["price"] . '">
                            <input type="text" name="type" style="display: none" value="' . $service["name"] . '">
                            <input type="submit" value="PLATBA">
                        </form>
                        ' . $service["price"] . '€
                    </div>
              </div>';
    }
}

function printHistory() {
    include_once ("./classes/Operations.php");

    $operations = new Operations();

    $data = $operations->getHistory();
    $data_count = count($data);
    $blank_rows_count = 5 - $data_count;

    $card = $operations->getData()["card_number"];

    for ($i = 0; $i < $data_count; $i++) {
        if ($data[$i]["type"] == "transaction") {
            if ($data[$i]["reciever"] == $card) {
                $arrow_direction = 'up';
                $arrow_alt = 'prijmy';
                $info = $data[$i]["sender"];
                $name = $data[$i]["sender_first_name"] . '  ' . $data[$i]["sender_last_name"];
            } else {
                $arrow_direction = 'down';
                $arrow_alt = 'vyplaty';
                $info = $data[$i]["reciever"];
                $name = $data[$i]["reciever_first_name"] . '  ' . $data[$i]["reciever_last_name"];
            }
        } else {
            $arrow_direction = 'down';
            $arrow_alt = 'vyplaty';
            $info = 'služby';
            $name = $data[$i]["type"];
        }

        echo '
            <tr>
                <td><img class="arrow" src="./img/arrows/' . $arrow_direction . '_arrow.png" alt="' . $arrow_alt . '"></td>
                <td>' . $name . '</td>
                <td>'. $info .'</td>
                <td>'. $data[$i]["date"] .'</td>
                <td>'. $data[$i]["amount"] .'€</td>
            </tr>
            ';
    }
    for  ($i = 0; $i < $blank_rows_count; $i++) {
        echo '
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            ';
    }
}

function printMessages() {
    include_once ("./classes/Messages.php");

    $messages = new Messages();
    $data = $messages->getMessages();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

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

    echo '
        <div id="qna_form_div">
            <form method="post" action=' . ((isset($_GET["update"])) ? "./forms/crud.php" : "./forms/send_message.php") . '>
                <input type="text" aria-label="Napíš sem správu" name="text"'. $text . ' autocomplete="off" id="text_input" ' . ((!$data) ? ' placeholder=" Napíš sem svojú prvú otázku"' : '') . '>
                ' . ((isset($_GET["update"])) ? '<input type="text" style="display: none" value="' . $_GET["update"] . '" name="id">' : '') . '
                ' . ((isset($_GET["response"])) ? '<input type="text" style="display: none" value="' . $_GET["response"] . '" name="id">' : '') . '
                <input type="image" alt="odoslať" src="./img/send_button.png" name="submit" id="send_input">
            </form>
        </div>
        ';
}