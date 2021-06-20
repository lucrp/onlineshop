<?php
require_once(__DIR__ . '/../../bootstrap.php');
redirect_unless_admin();
?>

<?php partial('header_admin', ['title' => 'Produits']) ?>

<div class="flex items-center mb-4 -mx-2">
    <h1 class="text-xl">Produits</h1>
    <a href="/admin/products_add.php" class="ml-3 border px-2 py-1 uppercase text-xs">Créer produit</a>
</div>


<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam architecto aut blanditiis debitis delectus facilis omnis unde? Ad illo nihil quis tempora vero. Culpa delectus ex in ipsam laboriosam nemo nisi sunt? A esse illo itaque iure modi non nostrum odit omnis, possimus quisquam reprehenderit sapiente, ut! Atque, deserunt doloribus dolorum eligendi enim id incidunt iste iure natus neque omnis pariatur, perferendis porro quae quam rem, voluptatibus. Incidunt laborum quisquam quod tenetur? Adipisci blanditiis eius, ipsa laboriosam perferendis porro quas vel. Consequuntur culpa dicta ducimus, earum eum hic ipsum iste iure, magnam nostrum odit quam qui quidem, quis recusandae repellat suscipit tempora! Accusamus ad, beatae consequuntur debitis delectus deserunt dignissimos earum, eius enim esse est facere harum inventore maiores modi molestiae mollitia nihil nostrum, numquam obcaecati officiis perspiciatis quisquam quos repellat tenetur unde veniam? A asperiores assumenda blanditiis maiores nisi officiis quaerat reprehenderit? Architecto aspernatur beatae consectetur deleniti eligendi error fuga incidunt ipsa laboriosam modi nisi omnis placeat quidem, rem rerum sint sunt tempora, tempore vitae voluptates? Accusantium alias aut autem beatae blanditiis commodi consectetur culpa delectus deleniti dolorum earum eveniet excepturi, fuga ipsa iure neque nihil nisi odio optio perferendis possimus praesentium provident quia quidem quis ratione recusandae repellendus soluta tempora tenetur! Asperiores corporis nisi omnis perspiciatis placeat quidem totam vel! Id itaque laboriosam voluptate. Adipisci cum dolor, eos expedita natus nobis officiis quibusdam quos voluptates. Explicabo fugiat, officia? Aperiam architecto assumenda dolores eum quis! A architecto asperiores, aspernatur consectetur cumque dolorem error expedita laboriosam magni nulla odit praesentium provident quis rerum tempora vitae voluptas voluptatem voluptatum. Magni, nesciunt obcaecati omnis quidem ratione tenetur unde voluptas? Beatae iusto labore maxime natus odit optio porro, repudiandae vel. Alias, ducimus ea odit ratione repellendus reprehenderit vel! Accusamus animi blanditiis culpa dolorem, eaque inventore iste itaque, libero odio officia officiis, provident temporibus?</p>

<?php partial('footer_admin') ?>
