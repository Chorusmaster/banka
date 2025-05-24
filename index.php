<?php
    include_once "./parts/head.php";
    include_once (__DIR__ . "/classes/Operations.php");
    include_once "./parts/header.php";

    $operations = new Operations();
    $userdata = ($operations->getData());
?>

<main>
    <div>
        <div id="card_div">
            <?php
                $number = $userdata["card_number"];
                $formatted_number = substr($number, 0, 4) . " " . substr($number, 4, 4) . " " . substr($number, 8, 4) . " " . substr($number, 12, 4);
                $date = substr($userdata["expiration_date"], 5, 2) . "/" . substr($userdata["expiration_date"], 2, 2);

                echo '<div id="card_number">' . $formatted_number . '</div>';
                echo '<div id="customer_name">' . $userdata["first_name"] . " " . $userdata["last_name"] . '</div>';
                echo '<div id="expiration_date">' . $date . '</div>'
            ?>
            <img id="card" src="./img/card.png" alt="Kreditka">
        </div>

        <?php
            if (isset($_GET['transfer'])) {
                echo '
                    <div id="transfer-container">
                        <form id="container" class="transfer" method="POST" action="./forms/transfer.php">
                            <h2>Prevod</h2>
                            <label for="to">Čislo</label>
                            <input type="text" id="to" name="to">
                            <label for="amount">Suma</label>
                            <input type="text" autocomplete="off" id="amount" name="amount">
                            <a href="index.php" class="transfer_button">Zrušiť</a>
                            <input class="transfer_button" type="submit" id="ok">
                        </form>
                    </div>
                ';
            }
        ?>

        <div id="card_info" <?php if (isset($_GET['transfer'])) echo "style='display: none'"?>>
            <div id="balance">
                <?php
                    $path = __DIR__ . "\data\currencies.json";
                    $data = json_decode(file_get_contents($path), true);
                    $currency = isset($_GET['currency']) ? $_GET['currency'] : 'eur';
                    echo (round($data[$currency][0] * $userdata["balance"], 1));
                    echo ($data[$currency][1]);
                ?>
            </div>

            <div id="currencies">
                <?php
                    $chosen_currency = isset($_GET['currency']) ? $_GET['currency'] : 'eur';
                    foreach ($data as $currency => $info) {
                        echo '<button ' . (($chosen_currency == $currency) ? 'class="chosen" ' : '') .
                            'onclick="' . "window.open('index.php?currency=" . $currency ."', '_self')" . '">' . $info[1] . '</button>';
                    }
                ?>
            </div>
            <button onclick="window.open('index.php?transfer=true', '_self')">PREVOD PEŇAZÍ</button>
        </div>
    </div>

    <hr class="hr_decoration">

    <div id="banner2">
        <?php
            printServices();
        ?>
    </div>
</main>

    <?php
    include_once "./php/error_catch.php";
    ?>

    <script>
        window.isTransfer = <?php echo(isset($_GET['transfer']));?>
    </script>

    <script src="./js/transfer_validation.js"></script>

<?php
include "./parts/footer.php";
?>