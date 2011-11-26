<?php
try {
    $yhteys = new PDO("pgsql:host=localhost;dbname=tahuomo", "tahuomo", "1c6f3a74b4bc3234");
} catch (PDOException $e) {
    die("TIETOKANTAVIRHE: " . $e->getMessage());
}
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>