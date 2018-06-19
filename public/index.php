<?php
$debug = false;
if ($debug) {
    ini_set('opcache.enable', 'Off');
}

function convert($size)
{
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');

    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2).' '.$unit[$i];
}

#echo '<h1>'.convert(memory_get_usage()) . "\n".'</h1>';

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
#echo '<h1>'.convert(memory_get_usage()) . "\n".'</h1>'; // 36640