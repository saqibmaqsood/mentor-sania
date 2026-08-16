<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Clean URL → PHP file mapping
$pages = [
    '/about'      => 'about.php',
    '/courses'    => 'courses.php',
    '/services'   => 'services.php',
    '/consulting' => 'consulting.php',
    '/contact'    => 'contact.php',
    '/faq'        => 'faq.php',
    '/legal'      => 'legal.php',
    '/resources'  => 'resources.php',
];

foreach ($pages as $route => $file) {
    if ($uri === $route || $uri === $route . '/') {
        require __DIR__ . '/' . $file;
        exit;
    }
}

// Dynamic course detail
if (preg_match('#^/courses/([a-zA-Z0-9_-]+)/?$#', $uri, $matches)) {
    $_GET['c'] = $matches[1];
    require __DIR__ . '/course-detail.php';
    exit;
}

// Dynamic resource detail
if (preg_match('#^/resources/([a-zA-Z0-9_-]+)/?$#', $uri, $matches)) {
    $_GET['r'] = $matches[1];
    require __DIR__ . '/resource-detail.php';
    exit;
}

// Admin panel
if ($uri === '/panel' || $uri === '/panel/') {
    require __DIR__ . '/panel/index.php';
    exit;
}

return false;
