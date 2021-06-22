<div class="mb-4 max-w-sm">
    <label for="<?= $name ?>" class="block text-sm">Nom :</label>
    <input type="<?= $type ?? 'text' ?>" name="<?= $name ?>" id="<?= $name ?>" class="border border-gray focus:border-black px-4 py-1 w-full"
           value="<?= get_previous_input('name') ?? $model->{$name} ?>">
    <?php if (get_previous_error('name')) : ?>
        <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500 mt-2">
            <?= get_previous_error('name') ?>
        </p>
    <?php endif; ?>
</div>