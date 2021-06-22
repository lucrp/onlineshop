<?php
require_once(__DIR__ . '/../../../bootstrap.php');
redirect_unless_admin();

import_lib('products');
import_lib('categories');

$categories = get_all_categories();

$query = pdo()->prepare('SELECT * FROM products WHERE id = ?');
$query->setFetchMode(PDO::FETCH_CLASS, Product::class);
$query->execute([$_GET['id']]);
$product = $query->fetch();


if (! $product) {
    abort_404();
}


if (is_post()) {


    validate([
        'category_id' => ['required'],
        'name' => ['required'],
        'description' => ['required']
    ]);

    $query = pdo()->prepare('UPDATE products SET category_id = ?, name = ?, description = ? WHERE id = ?');
    $query->execute([$_POST['category_id'] ,$_POST['name'], $_POST['description'], $product->id]);

    flash_success("Le produit « $product->name » a bien été enregistré !");
    redirect("/admin/products/edit.php?id=$product->id");
}

?>

<?php partial('header_admin', ['title' => 'Ajouter un produit']) ?>

<h1 class="text-xl">Modifier "<?= $product->name ?>" </h1>

<form method="post">
    <!-- <?php //partial('input', ['label' => 'Nom', 'name' => 'name', 'model' => $product ]) ?>   -->
    <div class="mb-4 max-w-sm">
        <label for="name" class="block text-sm">Nom :</label>
        <input type="text" name="name" id="name" class="border border-gray focus:border-black px-4 py-1 w-full"
               value="<?= get_previous_input('name') ?? $product->name ?>">
        <?php if (get_previous_error('name')) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= get_previous_error('name') ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="mb-4 max-w-sm">
        <label for="name" class="block text-sm">Description :</label>
        <textarea name="description" id="description"
                  class="border border-gray focus:border-black px-4 py-1 w-full h-48" rows="30" cols="12"><?= get_previous_input('description') ?? $product->description ?></textarea>
        <?php if (get_previous_error('description')) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= get_previous_error('description') ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="mb-4 max-w-sm">
        <label for="category_id" class="block text-sm">Catégorie :</label>
        <select name="category_id" id="category_id" class="w-full border border-gray focus:border-black px-4 py-1 text-sm bg-gray-100 ">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category->id ?>" <?= $category->id === (get_previous_input('category_id') ??  $product->category_id) ? 'selected' : '' ?>>
                    <?= $category->name ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (get_previous_error('category_id')) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= get_previous_error('category_id') ?>
            </p>
        <?php endif; ?>
    </div>
    <p class="mt-6 max-w-sm">
        <button class="w-full border py-1">Modifier</button>
    </p>
</form>

<?php partial('footer_admin') ?>
