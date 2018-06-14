<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit543416e3e5e8d5c145661fd6abb9cc6d
{
    public static $files = array (
        'c1543423b1d28fcfdad7490e3e8afcc9' => __DIR__ . '/..' . '/debug/debugHelper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Gifts\\HttpFoundation\\ControllerResolver' => __DIR__ . '/..' . '/http-foundation/ControllerResolver.php',
        'Gifts\\HttpFoundation\\Exception\\RouteNotFoundException' => __DIR__ . '/..' . '/http-foundation/Exception/RouteNotFoundException.php',
        'Gifts\\HttpFoundation\\ParameterBag' => __DIR__ . '/..' . '/http-foundation/ParameterBag.php',
        'Gifts\\HttpFoundation\\Request' => __DIR__ . '/..' . '/http-foundation/Request.php',
        'Gifts\\HttpFoundation\\Router\\Route' => __DIR__ . '/..' . '/http-foundation/Router/Route.php',
        'Gifts\\HttpFoundation\\Router\\RouteCollection' => __DIR__ . '/..' . '/http-foundation/Router/RouteCollection.php',
        'Gifts\\HttpFoundation\\ServerBag' => __DIR__ . '/..' . '/http-foundation/ServerBag.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit543416e3e5e8d5c145661fd6abb9cc6d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit543416e3e5e8d5c145661fd6abb9cc6d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit543416e3e5e8d5c145661fd6abb9cc6d::$classMap;

        }, null, ClassLoader::class);
    }
}
