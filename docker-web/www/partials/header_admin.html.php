<?php partial('header', ['title' => "$title - Admin"]) ?>

<div class="flex max-w-5xl w-full mx-auto mt-8">
    <nav class="mr-6 w-48 flex-shrink-0 py-8">
        <div class="-my-1">
            <div class="w-full my-1 py-2 px-3 <?= is_on_page('dashboard') ? 'bg-gray-300' : '' ?>">
                <a class="font-medium text-gray-600 hover:text-black" href="/public/admin/dashboard.php">
                    Tableau de bord
                </a>
            </div>
            <div class="w-full my-1 py-2 px-3  <?= is_on_directory('/public/admin/products') ? 'bg-gray-300' : '' ?>">
                <a class="font-medium text-gray-600 hover:text-black" href="/public/admin/products/index.php">
                    Produits
                </a>
            </div>
            <div class="w-full my-1 py-2 px-3  <?= is_on_page('stats') ? 'bg-gray-300' : '' ?>">
                <a class="font-medium text-gray-600 hover:text-black" href="/public/admin/stats.php">
                    Statistiques
                </a>
            </div>
            <div class="w-full my-1 py-2 px-3">
                <form method="post" action="/public/admin/logout.php">
                    <button class="font-medium text-gray-600 hover:text-black">Déconnexion</button>
                </form>
            </div>

        </div>
    </nav>
    <main class="bg-white shadow-xl p-8 w-full relative">
        <?php if ($flash = get_flash()): ?>
            <div class="absolute right-0">
                <p class="-mt-12 mr-3 px-6 py-3 max-w-sm shadow-lg <?= $flash['type'] === 'success' ? 'bg-green-100 text-green-900' : '' ?>">
                    <?= $flash['message'] ?>
                </p>
            </div>
        <?php endif; ?>