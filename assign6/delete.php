<?php
/**
 * Created by PhpStorm.
 * User: lsirdevan
 * Date: 11/8/17
 * Time: 4:18 PM
 */

require('db_connection.php');

$stmt = $dbh->prepare('DELETE FROM `jobs` WHERE `id` = ?');
$stmt->execute([$_GET['id']]);

header('Location: index.php');