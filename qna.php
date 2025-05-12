<?php
    include "./parts/head.php";
    include "./parts/header.php";
?>

<main>
    <h2 id="qna_title">Otázky a odpovede</h2>

    <div id="container" class="qna_container">
        <div class="message my_message">
            Čo robiť?
            <div class="date">24.03.2025</div>
        </div>
        <div class="message answer_message">
            Počkajte, prosím, na odpoveď administratora
            <div class="date">24.03.2025</div>
        </div>
        <div class="message answer_message">
            Shiiiish, piť pivo
            <div class="date">24.03.2026</div>
        </div>
        <div id="qna_form_div">
            <form>
                <input type="text" id="text_input">
                <input type="image" src="./img/send_button.png" id="send_input">
            </form>
        </div>
    </div>
</main>

<?php
include "./parts/footer.php";
?>