<?php
    include "./parts/head.php";
    include "./parts/header.php";
?>

<main>
    <img class="decoration_arrow1" src="./img/decoration_arrow.png" alt="dekoratívna šípka">
    <img class="decoration_arrow2" src="./img/decoration_arrow.png" alt="dekoratívna šípka">

    <h2>História platieb</h2>
    <div id="container">
        <table>
            <?php
                include_once ("./php/structure_functions.php");
                printHistory();
            ?>
        </table>
    </div>
</main>

<?php
include "./parts/footer.php";
?>