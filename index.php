<!doctype html>
<html lang=sk>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'> <!--font-->

    <link rel="stylesheet" type="text/css" href="css/general_styles.css">
    <link rel="stylesheet" type="text/css" href="css/index_styles.css">

    <title>Žbanka</title>
</head>
<body>
    <header>
        <nav>
            <a href = "index.php"><img id="nav_logo" src="./img/logo.png" alt="logotyp"></a>
            <a class="chosen" href = "index.php">DOMOV</a></li>
            <a href = "history.php">HISTÓRIA</a></li>
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
        <div>
            <div id="card_div">
                <div id="card_number">1111 1111 1111 1111</div>
                <div id="customer_name">Gena Bukin</div>
                <div id="expiration_date">10/28</div>
                <img id="card" src="./img/card.png" alt="Kreditka">
            </div>

            <div id="card_info">
                <div id="balance">100€</div>
                <div id="currencies">
                    <button class="chosen">€</button>
                    <button>$</button>
                    <button>£</button>
                    <button>¥</button>
                    <button>₹</button>
                    <button>₴</button>
                </div>
                <button>PREVOD PEŇAZÍ</button>
            </div>
        </div>

        <hr class="hr_decoration">

        <div id="banner2">
            <div>
                <img class="offer" src="./img/offers/scam_offer.png">
                <div class="offer_name">Podvodníci corp.</div>
                <div class="offer_description">Bojite sa, že vám ukradnú peniaze? Pošlite ich sámi! Podporte domácich podvodníkov!</div>
                <div class="offer_payment">
                    <button>PLATBA</button>
                    20€
                </div>
            </div>
            <div>
                <img class="offer" src="./img/offers/travel_agency_offer.png">
                <div class="offer_name">MaxCesta</div>
                <div class="offer_description">Vychutnajte si nádhernú dovolenku spolu s cestovnou kanceláriou MaxCesta</div>
                <div class="offer_payment">
                    <button>PLATBA</button>
                    180€
                </div>
            </div>
            <div>
                <img class="offer" src="./img/offers/insurance_offer.png">
                <div class="offer_name">Super poistenie</div>
                <div class="offer_description">Toto je super ultra mega dobré, lacné a kvalitné poistenie. Od čoho? Ani netusím.</div>
                <div class="offer_payment">
                    <button>PLATBA</button>
                    999€
                </div>
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