<?php
    if (isset($_SESSION["error"])) {
        echo '
            <script>
                alert("' . $_SESSION["error"] . '");
            </script>
        ';
        unset($_SESSION["error"]);
    }