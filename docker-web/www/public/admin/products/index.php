<?php
require_once(__DIR__ . '/../../../bootstrap.php');
redirect_unless_admin();

import_lib('products');

$query = pdo()->query('SELECT * FROM products');
$products = $query->fetchAll(PDO::FETCH_CLASS, Product::class);

?>

<?php partial('header_admin', ['title' => 'Produits']) ?>

<div class="flex items-center mb-4 -mx-2">
    <h1 class="text-xl">Produits</h1>
    <a href="../products/add.php" class="ml-3 border px-2 py-1 uppercase text-xs">Créer produit</a>
</div>

<?php foreach ($products as $product) : ?>
    <div class="my-3">
        <h2 class="text-lg"><?= "« $product->name »" ?></h2>
        <p><?= $product->description ?></p>
        <div class="flex -mx-2 py-3 text-sm border-t pt-1 mt-1">
            <a class="mx-2" href="/admin/products/edit.php?id=<?= $product->id ?>">Modifier</a>
            <form class="mx-2" method="post" action="/admin/products/delete.php?id=<?=$product->id?>">
                <button>Supprimer</button>
            </form>
        </div>
    </div>
<?php endforeach ; ?>


<?php partial('footer_admin') ?>
