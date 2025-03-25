<!doctype html>
<html lang=sk>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'> <!--font-->

    <link rel="stylesheet" type="text/css" href="css/general_styles.css">
    <link rel="stylesheet" type="text/css" href="css/history_styles.css">

    <title>Žbanka</title>
</head>
<body>
    <header>
        <nav>
            <a href = "index.php"><img id="nav_logo" src="./img/logo.png" alt="logotyp"></a>
            <a href = "index.php">DOMOV</a></li>
            <a class="chosen" href = "history.php">HISTÓRIA</a></li>
            <a href = "qna.php">OTÁZKY</a></li>
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
        <img class="decoration_arrow1" src="./img/decoration_arrow.png" alt="dekoratívna šípka">
        <img class="decoration_arrow2" src="./img/decoration_arrow.png" alt="dekoratívna šípka">

        <h2>História platieb</h2>
        <div id="container">
            <table>
                <tr>
                    <td><img class="arrow" src="./img/arrows/up_arrow.png" alt="príjmy"></td>
                    <td>MaxCesta</td>
                    <td>02.07.2007 22:30</td>
                    <td>120€</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
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