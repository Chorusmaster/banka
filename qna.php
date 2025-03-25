<!doctype html>
<html lang=sk>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'> <!--font-->

    <link rel="stylesheet" type="text/css" href="css/general_styles.css">
    <link rel="stylesheet" type="text/css" href="css/qna_styles.css">

    <title>Žbanka</title>
</head>
<body>
    <header>
        <nav>
            <a href = "index.php"><img id="nav_logo" src="./img/logo.png" alt="logotyp"></a>
            <a href = "index.php">DOMOV</a></li>
            <a href = "history.php">HISTÓRIA</a></li>
            <a class="chosen" href = "qna.php">OTÁZKY</a></li>
        </nav>

        <div class="banner">
            <h1>ŽBANKA</h1>
            <?php
            if (!include("php/citations.php")) {
                echo "<em>Ooops, citácie nie sú k dispozícii</em>";
            }
            ?>
        </div>
    </header>

    <hr class="hr_decoration">

    <main>
        <h2 id="qna_title">Otázky a odpovede</h2>

        <div class="qna_container" id="container">
            <div class="message my_message">
                Čo robiť?
                <div class="date">24.03.2025</div>
            </div>
            <div class="message answer_message">
                Počkajte, prosím na odpoveď administratora
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

    <footer>
        <div>© 2024 - 2025 Žbanka foundation - all rights reserved</div>
        <div id="right_footer_div">
            <a href=tel:"4211234567890">+421 123 4567 890</a>
            <a href=mailto:"zbanka.foundation@zb.sk">zbanka.foundation@zb.sk</a>
        </div>
    </footer>
</body>
</html>