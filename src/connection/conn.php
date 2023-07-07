<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$path = dirname(__FILE__, 2);

$dotenv = Dotenv::createImmutable($path);
$dotenv->load();

try {
  $conn = new PDO('mysql:host=' . $_ENV['HOST_NAME'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['USER_PASSWORD']);
} catch (\PDOException $e) {
  // only in dev
  echo $e;
}