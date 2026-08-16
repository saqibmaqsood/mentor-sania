<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve real static files directly
if ($uri !== '/' && is_file(__DIR__ . $uri)) {
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

// Admin panel routing
if ($uri === '/panel' || $uri === '/panel/' || $uri === '/panel/index.php') {
    require __DIR__ . '/panel/index.php';
    exit;
}

if (strpos($uri, '/panel/') === 0) {
    $panelFile = __DIR__ . $uri;
    if (is_file($panelFile)) {
        require $panelFile;
        exit;
    }
    if (is_file($panelFile . '.php')) {
        require $panelFile . '.php';
        exit;
    }
}

return false;
