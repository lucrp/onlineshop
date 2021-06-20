<?php

function pdo()
{
    static $pdo;
    if ($pdo) {
        return $pdo;
    }
    $pdo = new PDO('pgsql:host=web-pgsql;port=5432;dbname=onlineshop', 'onlineshop', 'onlineshop');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
