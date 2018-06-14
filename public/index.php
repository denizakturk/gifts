<?php

use App\Kernel;
use Gifts\HttpFoundation\Request;
$debug = true;
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