<?php
require_once(__DIR__ . '/../../bootstrap.php');
redirect_unless_admin();

if (!is_post()) {
    abort_404();
}

if(is_post()) {
    unset($_SESSION['admin']);
    redirect('login.php');
}

