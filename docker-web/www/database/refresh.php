<?php
require_once(__DIR__ . '/../bootstrap.php');

$pdo = pdo();

// fonction Postgres pour suprimmer toutes les tables (DROP TABLES)
$pdo->exec("
DO $$ DECLARE
    r RECORD;
BEGIN
    -- if the schema you operate on is not 'current', you will want to
    -- replace current_schema() in query with 'schematodeletetablesfrom'
    -- *and* update the generate 'DROP...' accordingly.
    FOR r IN (SELECT tablename FROM pg_tables WHERE schemaname = current_schema()) LOOP
        EXECUTE 'DROP TABLE IF EXISTS ' || quote_ident(r.tablename) || ' CASCADE';
    END LOOP;
END $$;
");

$pdo->exec('CREATE TABLE admins (
        id SERIAL PRIMARY KEY,
        name TEXT UNIQUE NOT NULL,  
        password TEXT NOT NULL
    )');

$pdo->exec('CREATE TABLE categories (
        id SERIAL PRIMARY KEY,
        slug TEXT UNIQUE NOT NULL,  
        name TEXT NOT NULL
    )');

$pdo->exec("INSERT INTO categories (slug, name) VALUES ('carnets-de-sante', 'Carnets de santé')");
$pdo->exec("INSERT INTO categories (slug, name) VALUES ('gigoteuses', 'Gigoteuses')");

$pdo->exec('CREATE TABLE products (
        id SERIAL PRIMARY KEY,
        category_id INTEGER NOT NULL REFERENCES categories, 
        name TEXT NOT NULL,  
        description TEXT NOT NULL
    )');