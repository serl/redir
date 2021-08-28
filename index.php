<?php

if (!include(__DIR__ . '/settings.php')) {
    http_response_code(500);
    die("Unable to load configuration file");
}

$current_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if ($current_path == 'robots.txt') {
    header('Content-type: text/plain; charset=UTF-8');
    echo "User-agent: *\nDisallow: /\n";
    exit;
}

if ($url = $settings['redirects'][$current_path] ?? false) {
    header("Location: $url");
    exit;
}

http_response_code(404);
