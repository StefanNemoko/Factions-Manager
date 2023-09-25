<?php
// Includes all files that are needed constantly for stuff... Certain controllers won't be included/required here...

// Controllers
require_once ROOT . "controllers/home.php";
require_once ROOT . "controllers/api.php";


function require_all($dir, $max_scan_depth, $depth=0) {
    if ($depth > $max_scan_depth) {
        return;
    }

    // require all php files
    $scan = glob("$dir/*");
    foreach ($scan as $path) {
        if (preg_match('/\.php$/', $path)) {
            require_once $path;
        }
        elseif (is_dir($path)) {
            require_all($path, $max_scan_depth, $depth+1);
        }
    }
}

$max_depth = 255;
require_all('models', $max_depth);
require_all('core', $max_depth);
