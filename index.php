<?php
    include "./parts/head.php";
    include "./parts/header.php";
?>

<main>
    <div>
        <div id="card_div">
            <div id="card_number">1111 1111 1111 1111</div>
            <div id="customer_name">Gena Bukin</div>
            <div id="expiration_date">10/28</div>
            <img id="card" src="./img/card.png" alt="Kreditka">
        </div>

        <div id="card_info">
            <div id="balance">
                <?php
                    $path = __DIR__ . "\data\currencies.json";
                    $data = json_decode(file_get_contents($path), true);
                    $currency = isset($_GET['currency']) ? $_GET['currency'] : 'eur';
                    echo ($data[$currency][0] * 100);
                    echo ($data[$currency][1]);
                ?>
            </div>
            <div id="currencies">
                <button <?php if(!isset($_GET['currency']) || ($_GET['currency'] == 'eur')) echo('class="chosen"') ?>
                        onclick="window.open('index.php?currency=eur', '_self')">€</button>
                <button <?php if(isset($_GET['currency']) && ($_GET['currency'] == 'usd')) echo('class="chosen"') ?>
                        onclick="window.open('index.php?currency=usd', '_self')">$</button>
                <button <?php if(isset($_GET['currency']) && ($_GET['currency'] == 'gdp')) echo('class="chosen"') ?>
                        onclick="window.open('index.php?currency=gdp', '_self')">£</button>
                <button <?php if(isset($_GET['currency']) && ($_GET['currency'] == 'jpy')) echo('class="chosen"') ?>
                        onclick="window.open('index.php?currency=jpy', '_self')">¥</button>
                <button <?php if(isset($_GET['currency']) && ($_GET['currency'] == 'inr')) echo('class="chosen"') ?>
                        onclick="window.open('index.php?currency=inr', '_self')">₹</button>
                <button <?php if(isset($_GET['currency']) && ($_GET['currency'] == 'uah')) echo('class="chosen"') ?>
                        onclick="window.open('index.php?currency=uah', '_self')">₴</button>
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

<?php
include "./parts/footer.php";
?>