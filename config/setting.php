<?php

// Database Settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'demo');

// Site Settings
define('SITE_TITLE', 'Demo');

// PATH
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define("URL","http://{$_SERVER['SERVER_NAME']}");


// Helper functions
function url($url = "") {
    return URL . '/' . $url;
}

function path($path = "") {
    return ROOT_PATH . "/" . $path;
}

function limit($value, $limit = 100, $end = '...')
{
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
        return $value;
    }

    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}