<?php

use Dotenv\Dotenv;

require dirname(__FILE__, 4) . '/vendor/autoload.php';

Dotenv::createImmutable(dirname(__FILE__, 5))->load();

$dbname = $_ENV['DB_NAME'];
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$passwd = $_ENV['DB_PASS'];

$dsn = "mysql:dbname = {$dbname};host={$host};charset=utf8";

$driver_opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

error_reporting(E_ALL & ~E_NOTICE);

try {
    $dbh = new PDO($dsn, $user, $passwd, $driver_opts);
    echo 'Connected!' . PHP_EOL;
    // $stmt = $dbh->prepare($sql);
    //$stmt->bindValue();
    //$stmt->bindParam();
    // $stmt->execute();
    // $dbh->query('create database test;');
    // $dbh->query('use test;');
    $dbh->query('
        create table users (
            id int auto_increment,
            lv int,
            exp int,
            money int,
            primary key(id),
        );
    ');
    $stmt = $dbh->query('describe users;');
    while ($res = $stmt->fetchAll()) {
        print_r($res . PHP_EOL);
    }
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    // header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage() . PHP_EOL);
} finally {
    $dbh = null;
}
