<?php
include "./parts/head.php";
include "./parts/header.php";

$is_login = isset($_GET["type"]) && $_GET["type"] == "login";
?>

    <div class="banner">
        <br><br>
    </div>

    <div>
        <hr class="hr_decoration">

        <h2><?php echo $is_login ? "Prihlásiť sa" : "Zaregistrovať sa"?></h2>
        <form class="registration_container" method="post" action="forms/<?php echo $is_login ? "login" : "register"?>.php" id="container">

            <div class="input_container">
                <div class="input_block">
                    <label for="email">email</label>
                    <input type="email" name="email">
                </div>
                <div class="input_block">
                    <label for="login">login</label>
                    <input type="text" name="login">
                </div>
                <div class="input_block">
                    <label for="password">heslo</label>
                    <input type="password" name="password">
                </div>
            </div>

            <?php
                if(!$is_login) echo '
                <div class="input_container">
                <div class="input_block">
                    <label for="name">meno</label>
                    <input type="text" name="name">
                </div>
                <div class="input_block">
                    <label for="surname">priezvisko</label>
                    <input type="text" name="surname">
                </div>
                <div class="input_block">
                    <label for="birth">dátum narodenia</label>
                    <input type="date" name="birth">
                </div>
                </div>'
            ?>

            <input type="image" src="./img/ok_button.png" id="ok_input">
        </form>

        <hr class="hr_decoration">
    </div>

    <div class="banner">
        <br><br>
    </div>

<?php
include "./parts/footer.php";
?>