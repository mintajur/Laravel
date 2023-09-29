<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit64318af684073d5872b9b72d5b744091
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Banking_App\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Banking_App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/route',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit64318af684073d5872b9b72d5b744091::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit64318af684073d5872b9b72d5b744091::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit64318af684073d5872b9b72d5b744091::$classMap;

        }, null, ClassLoader::class);
    }
}
