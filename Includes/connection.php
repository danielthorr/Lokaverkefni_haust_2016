<?php

$source = 'mysql:host=tsuts.tskoli.is;dbname=3010982789_lokaverkefni_haust_2016';
$user = '3010982789';
$password = 'ASDF1234';

// Sjá nánar um PDO t.d.: http://www.sitepoint.com/re-introducing-pdo-the-right-way-to-access-databases-in-php/
try {
    $connection = new PDO($source, $user, $password);
    # Notum utf-8 og gerum það með SQL fyrirspurn exec sendir sql fyrirspurnir til database
    $connection->exec('SET NAMES "utf8"');

} catch (PDOException $e) {
    echo 'Tenging mistókst: ' . $e->getMessage();
}
