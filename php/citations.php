<?php
    $data = json_decode(file_get_contents("./data/citations.json"), true);
    $citations = $data["citation"];
    $size = sizeof($citations);
    echo "<em>" . $citations[rand(0, $size - 1)] . "</em>";
?>
