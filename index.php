<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

if (!defined('STDIN')) {
    define('STDIN', fopen('php://stdin', 'r'));
}

define('LARAVEL_START', microtime(true));
/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that ANY pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/
header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Methods", "DELETE, POST, GET, OPTIONS");
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {//send back preflight request response
    return '';
}
if (file_exists(__DIR__.'/storage/framework/maintenance.php')) {
    require __DIR__.'/storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app      = require_once __DIR__.'/bootstrap/app.php';

$kernel   = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
