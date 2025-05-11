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

    if (!$isValid) return false;
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
