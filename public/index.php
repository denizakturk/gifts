<?php
$debug = true;
if($debug){
    ini_set('opcache.enable', 'Off');
}

function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

#echo '<h1>'.convert(memory_get_usage()) . "\n".'</h1>';

use App\Kernel;
use Gifts\HttpFoundation\Request;

include "../vendor/autoload.php";


try {
    $request = new Request();
    $kernel = new Kernel($request);
    $kernel->run();
} catch (Exception $e){
    if($debug){
        dump($e);

    } else {

    }
} catch (Throwable $e){
    if($debug){
        dump($e);
    }
}
#echo '<h1>'.convert(memory_get_usage()) . "\n".'</h1>'; // 36640