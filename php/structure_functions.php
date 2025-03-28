<?php
function validatePagename($getCSS=false) {
    $page_name = basename($_SERVER['REQUEST_URI'], ".php");
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
    echo "<a href = 'index.php'><img id='nav_logo' src='./img/logo.png' alt='logotyp'></a>";

    $page_data = json_decode(file_get_contents("data/pages_register.json"), true);
    $page_keys = array_keys($page_data);

    if (($page_name = validatePagename()) !== "none") {
        foreach ($page_keys as $key) {
            if ($key == $page_name) echo "<a class='chosen' href = '" . $key . '.php' . "'>" . $page_data[$key]["nav_name"] . "</a></li>";
            else echo "<a href = " . $key . '.php' . ">" . $page_data[$key]["nav_name"] . "</a></li>";
        }
    }
}
