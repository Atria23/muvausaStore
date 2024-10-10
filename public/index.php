
text/x-generic index.php ( PHP script, ASCII text )
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../muvausastore/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../muvausastore/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../muvausastore/bootstrap/app.php')
    ->handleRequest(Request::capture());

// use Illuminate\Http\Request;

// define('LARAVEL_START', microtime(true));

// // Determine if the application is in maintenance mode...
// if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
//     require $maintenance;
// }

// // Register the Composer autoloader...
// require __DIR__.'/../vendor/autoload.php';

// // Bootstrap Laravel and handle the request...
// (require_once __DIR__.'/../bootstrap/app.php')
//     ->handleRequest(Request::capture());