<?php
require_once(__DIR__ . '/../../../bootstrap.php');
redirect_unless_admin();

import_lib('products');

$query = pdo()->prepare('SELECT * FROM products WHERE id = ?');
$query->setFetchMode(PDO::FETCH_CLASS, Product::class);
$query->execute([$_GET['id']]);
$product = $query->fetch();


if (! $product) {
    abort_404();
}


if (is_post()) {

    validate([
            'name' => ['required'],
            'description' => ['required']
    ]);

    $query = pdo()->prepare('UPDATE products SET name = ?, description = ? WHERE id = ?');
    $query->execute([$_POST['name'], $_POST['description'], $product->id]);

    flash_success("Le produit « $product->name » a bien été enregistré !");
    redirect("/public/admin/products/edit.php?id=$product->id");
}

?>

<?php partial('header_admin', ['title' => 'Ajouter un produit']) ?>

<h1 class="text-xl">Modifier "<?= $product->name ?>" </h1>

<form method="post">
    <div class="mb-4 max-w-sm">
        <label for="name" class="block text-sm">Nom :</label>
        <input type="text" name="name" id="name" class="border border-gray focus:border-black px-4 py-1 w-full"
               value="<?= $previous_inputs['name'] ?? $product->name ?>">
        <?php if (isset($previous_errors['name'])) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= $previous_errors['name'] ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="mb-4 max-w-sm">
        <label for="name" class="block text-sm">Description :</label>
        <textarea name="description" id="description"
                  class="border border-gray focus:border-black px-4 py-1 w-full h-48" rows="30" cols="12"><?= $previous_inputs['description'] ?? $product->description ?></textarea>
        <?php if (isset($previous_errors['description'])) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= $previous_errors['description'] ?>
            </p>
        <?php endif; ?>
    </div>
    <p class="mt-6 max-w-sm">
        <button class="w-full border py-1">Modifier</button>
    </p>
</form>

<?php partial('footer_admin') ?>
