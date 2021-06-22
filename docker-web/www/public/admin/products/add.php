<?php
require_once(__DIR__ . '/../../../bootstrap.php');
redirect_unless_admin();

import_lib('categories');
$categories = get_all_categories();

if (is_post()) {
    validate([
        'category_id' => ['required'],
        'name' => ['required'],
        'description' => ['required'],
    ]);


    $query = pdo()->prepare('INSERT INTO products (category_id, name, description) VALUES (?, ?, ?)');
    $query->execute([$_POST['category_id'], $_POST['name'], $_POST['description']]);

    flash_success("Le produit {$_POST['name']} a bien été ajouté !");
    redirect('/admin/products/index.php');
}

?>

<?php partial('header_admin', ['title' => 'Ajouter un produit']) ?>

<h1 class="text-xl">Ajouter un produit</h1>

<form method="post">
    <div class="mb-4 max-w-sm">
        <label for="name" class="block text-sm">Nom :</label>
        <input type="text" name="name" id="name" class="border border-gray focus:border-black px-4 py-1 w-full bg-gray-100"
               value="<?= get_previous_input('name') ?>">
        <?php if (get_previous_error('name')) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= get_previous_error('name') ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="mb-4 max-w-sm">
        <label for="description" class="block text-sm">Description :</label>
        <textarea name="description" id="description"
                  class="border border-gray focus:border-black px-4 py-1 w-full h-48 bg-gray-100" rows="30" cols="12"><?= get_previous_input('description') ?></textarea>
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
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (get_previous_error('category_id')) : ?>
                    <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                        <?= get_previous_error('category_id') ?>
                    </p>
                <?php endif; ?>
            </div>
    <p class="mt-6 max-w-sm">
        <button class="w-full border py-1">Ajouter</button>
    </p>
</form>

<?php partial('footer_admin') ?>
