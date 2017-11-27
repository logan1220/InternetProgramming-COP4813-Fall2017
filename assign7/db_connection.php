<?php
/**
 * Created by PhpStorm.
 * User: lsirdevan
 * Date: 11/8/17
 * Time: 2:54 PM
 */

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_WARNING);

$servername = "localhost";
$username = "n00895918";
$password = "fall2017895918";

try {
    $dbh = new PDO("mysql:host=$servername;dbname=n00895918", $username, $password);
    // set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
    die("Connection failed: " . $e->getMessage());
}

?>