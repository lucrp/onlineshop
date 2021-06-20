<?php
require_once(__DIR__ . '/../../../bootstrap.php');
redirect_unless_admin();

import_lib('categories');
$categories = get_all_categories();

if (is_post()) {
    validate([
            'name' => ['required'],
            'description' => ['required'],
    ]);


    $query = pdo()->prepare('INSERT INTO products (name, description) VALUES (?, ?)');
    $query->execute([$_POST['name'], $_POST['description']]);

    flash_success("Le produit {$_POST['name']} a bien été ajouté !");
    redirect('/admin/products/index.php');
}

?>

<?php partial('header_admin', ['title' => 'Ajouter un produit']) ?>

<h1 class="text-xl">Ajouter un produit</h1>

<form method="post">
    <div class="mb-4 max-w-sm">
        <label for="name" class="block text-sm">Nom :</label>
        <input type="text" name="name" id="name" class="border border-gray focus:border-black px-4 py-1 w-full"
               value="<?= $previous_inputs['name'] ?? '' ?>">
        <?php if (isset($previous_errors['name'])) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= $previous_errors['name'] ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="mb-4 max-w-sm">
        <label for="description" class="block text-sm">Description :</label>
        <textarea name="description" id="description"
                  class="border border-gray focus:border-black px-4 py-1 w-full h-48" rows="30" cols="12"><?= $previous_inputs['description'] ?? '' ?></textarea>
        <?php if (isset($previous_errors['description'])) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= $previous_errors['description'] ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="mb-4 max-w-sm">
        <label for="category" class="block text-sm">Catégorie :</label>
        <select name="category" id="category">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($previous_errors['category'])) : ?>
            <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
                <?= $previous_errors['category'] ?>
            </p>
        <?php endif; ?>
    </div>
    <p class="mt-6 max-w-sm">
        <button class="w-full border py-1">Ajouter</button>
    </p>
</form>

<?php partial('footer_admin') ?>
