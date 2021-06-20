<?php


class Product
{
    public $id;
    public $name;
    public $description;

}


function find_product($id): Product
{
    $query = pdo()->prepare('SELECT * FROM products WHERE id = ?');
    $query->setFetchMode(PDO::FETCH_CLASS, Product::class);
    $query->execute([$id]);

    return $query->fetch() ?? abort_404();
}