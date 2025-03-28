<body>
<header>
    <nav>
        <?php
            include_once "php/structure_functions.php";
            printNavBar()
        ?>
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