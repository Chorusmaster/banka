<body>
<header>
    <nav>
        <?php
            include_once "php/structure_functions.php";
            printNavBar()
        ?>
    </nav>

    <?php
        $page_name = basename($_SERVER['REQUEST_URI'], ".php");
        if ($page_name != "registration") {
            echo('<div class="banner">');
            echo('<h1>ŽBANKA</h1>');
            if (!include("php/citations.php")) {
                echo "<em>Ooops, citácie nie sú k dispozícii</em>";
            }
            echo('</div>');
            echo('<hr class="hr_decoration">');
        }
    ?>
</header>
