<?php
    include "./parts/head.php";
    include_once "./parts/header.php";
?>

<main>
    <h2 id="qna_title">Otázky a odpovede</h2>
    <div id="container" class="qna_container">
        <?php
        include_once ("./php/structure_functions.php");
        printMessages();
        ?>
    </div>
</main>

<?php
include "./parts/footer.php";
?>