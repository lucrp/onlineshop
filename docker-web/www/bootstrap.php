<?php

ini_set('display_errors', 1);

session_start();

global $flash;
if (is_post()) {
    $previous_inputs = [];
} else {
    $previous_inputs = $_SESSION['previous_inputs'] ?? [];
    $_SESSION['previous_inputs'] = [];
}

function partial($name, $params = [])
{
    extract($params);
    require(__DIR__ . '/partials/' . $name . '.html.php');
}

function is_post()
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'CLI' ) === 'POST';
}

function redirect($url)
{
    header("Location: $url");
    die();
}

function redirect_self()
{
    redirect($_SERVER['REQUEST_URI']);
}


function redirect_unless_admin()
{
    if (!($_SESSION['admin'] ?? null)) {
        redirect('login.php');
    }
}


function abort_404()
{
    http_response_code(404);
    echo 'Page 404';
    die();
}

function is_on_page($page_name): bool
{
    return str_contains($_SERVER['SCRIPT_NAME'], "$page_name");
}

function is_on_directory($directory): bool
{
    return str_starts_with($_SERVER['SCRIPT_NAME'], $directory);
}

function import_lib($lib)
{
    require_once(__DIR__ . "/lib/$lib.php");
}

function save_inputs()
{
    foreach ($_POST as $key => $value) {
        if (in_array($key, ['password'])) {
            continue;
        }
        $_SESSION['previous_inputs'] =  $_SESSION['previous_inputs'] ?? [];
        $_SESSION['previous_inputs'][$key] = $value;
    }
}

function get_previous_inputs()
{
    static $previous_inputs;
    if ($previous_inputs) {
        return $previous_inputs;
    }

    $previous_inputs = $_SESSION['previous_inputs'] ?? [];
    $_SESSION['previous_inputs'] = [];
    return $previous_inputs;
}

function get_previous_input($key)
{
    return get_previous_inputs()[$key] ?? null;
}


import_lib('validation');
import_lib('flash');
import_lib('database');