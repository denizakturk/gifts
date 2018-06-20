<?php
$debug = false;

use App\Kernel;
use Gifts\HttpFoundation\Request;
use Gifts\Logging\LogWriter;

include "../vendor/autoload.php";

$error = null;

try {
    $request = new Request();
    $kernel = new Kernel($request);
    $kernel->run();
} catch (Throwable $e) {
    $logger = new LogWriter();
    if ($debug) {
        dump($e);
    } else {
        $logger->throwableLog($e);
    }
}