<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

if (preg_match('#^/courses/([a-zA-Z0-9_-]+)/?$#', $uri, $matches)) {
    $_GET['c'] = $matches[1];
    require __DIR__ . '/course-detail.php';
    exit;
}

if ($uri === '/services' || $uri === '/services/') {
    require __DIR__ . '/services.php';
    exit;
}

if ($uri === '/panel' || $uri === '/panel/') {
    require __DIR__ . '/panel/index.php';
    exit;
}

if (preg_match('#^/resources/([a-zA-Z0-9_-]+)/?$#', $uri, $matches)) {
    $_GET['r'] = $matches[1];
    require __DIR__ . '/resource-detail.php';
    exit;
}

return false;
