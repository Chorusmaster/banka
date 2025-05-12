<?php
    include "./parts/head.php";
    include_once (__DIR__ . "/classes/Operations.php");
    include "./parts/header.php";
?>

<main>
    <img class="decoration_arrow1" src="./img/decoration_arrow.png" alt="dekoratívna šípka">
    <img class="decoration_arrow2" src="./img/decoration_arrow.png" alt="dekoratívna šípka">

    <h2>História platieb</h2>
    <div id="container">
        <table>
            <?php
                $operations = new Operations();

                $data = $operations->getHistory();
                $data_count = count($data);
                $blank_rows_count = 5 - $data_count;

                $card = $operations->getData()[0]["card_number"];

                for ($i = 0; $i < $data_count; $i++) {
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
            ?>
        </table>
    </div>
</main>

<?php
include "./parts/footer.php";
?>