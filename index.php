<?php
    include "./parts/head.php";
?>

<?php
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

<?php
include "./parts/footer.php";
?>