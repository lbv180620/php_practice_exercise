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
    PDO::ATTR_EMULATE_PREPARES => true,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

error_reporting(E_ALL & ~E_NOTICE);

$sql = "create database php_work;
        show databases;
        use php_work;
        create table todo_items (
            id int auto_increment not null,
            expiration_data date not null,
            todo_item varchar(100) not null,
            is_completed tinyint default 0 not null,
            primary key(id),
        )
        default charset=utf8mb4_general_ci;
        show tables;";

try {
    $dbh = new PDO($dsn, $user, $passwd, $driver_opts);
    echo 'Connected!' . PHP_EOL;
    //$stmt = $dbh->prepare($sql);
    //$stmt->bindValue();
    //$stmt->bindParam();
    //$stmt->execute();
} catch (PDOException $e) {
    echo 'Connection Failed!' . PHP_EOL;
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage() . PHP_EOL);
} finally {
    unset($dsn);
}
