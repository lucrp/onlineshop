<?php
require_once(__DIR__ . '/../../bootstrap.php');

if ($_SESSION['admin'] ?? false) {
    redirect('/admin/dashboard.php');
}

if (is_post()) {
    $query = pdo()->prepare('SELECT * FROM admins WHERE name = ?');
    $query->execute([$_POST['name']]);
    $admin = $query->fetch();

    if ($admin and password_verify($_POST['password'], $admin['password'])) {
        $_SESSION['admin'] = $admin;

        redirect('dashboard.php');
    } else {
        $_SESSION['previous_errors']['credentials'] = 'Identifiants incorrects';
        save_inputs();
        redirect('login.php');
    }

}

?>

<?php partial('header', ['title' => 'Connexion Admin']) ?>

<div class="min-w-screen min-h-screen flex justify-center items-start bg-gray-100">
    <div class="bg-white shadow-lg p-8 mt-8">
        <h1 class="text-xl mb-4 text-center">Connexion Admin</h1>
        <form method="post">
            <?php if (get_previous_error('credentials')) : ?>
                <p class="border border-red-900 w-full bg-red-100 text-red-900 mb-4 px-3 py-1 text-sm text-red-500">
                    <?= get_previous_error('credentials') ?>
                </p>
            <?php endif; ?>
            <p class="mb-4">
                <label for="name" class="block text-sm">Nom :</label>
                <input type="text" name="name" id="name" class="border border-gray focus:border-black px-4 py-1 w-full" value="<?= get_previous_input('name') ?>" required>
            </p>
            <p class="mb-4">
                <label for="password" class="block text-sm">Mot de passe :</label>
                <input type="password" name="password" id="password" class="border border-gray focus:border-black px-4 py-1 w-full" required>
            </p>
            <p class="text-center">
                <button class="bg-gray-600 hover:bg-gray-700 px-8 py-1 text-white shadow-md">Connexion</button>
            </p>
        </form>
    </div>
</div>


<?php partial('footer') ?>