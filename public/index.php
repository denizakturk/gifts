<?php

use App\Kernel;
use Gifts\HttpFoundation\Request;
$debug = true;
if($debug){
    ini_set('opcache.enable', 'Off');
}
include "../vendor/autoload.php";

try {
    $kernel = new Kernel();

    $request = new Request();
    $kernel->handle($request);
} catch (Exception $e){
    if($debug){
        dump($e->getMessage());
    }
} catch (Throwable $e){
    if($debug){
        dump($e->getMessage());
    }
}