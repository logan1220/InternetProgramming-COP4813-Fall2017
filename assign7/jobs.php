<?php

require('db_connection.php');

$stmt = $dbh->prepare("SELECT * FROM `jobs` WHERE `id` = ?");

$stmt->execute([
    $_GET['jobId']
]);

die(json_encode($stmt->fetch(PDO::FETCH_ASSOC)));