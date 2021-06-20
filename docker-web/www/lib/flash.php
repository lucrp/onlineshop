<?php


function flash_success($message)
{
    flash('success', $message);
}

function flash($type, $message)
{
    $_SESSION['flash'] = compact('type', 'message');
}

function get_flash()
{
    $flash = $_SESSION['flash'] ?? null;
    $_SESSION['flash'] = null;
    return $flash;
}
