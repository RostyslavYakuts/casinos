<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2d11cefe8eae9ff38e7e899834b2fe1b
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Classes\\Casino\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Classes\\Casino\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes/casino',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2d11cefe8eae9ff38e7e899834b2fe1b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2d11cefe8eae9ff38e7e899834b2fe1b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2d11cefe8eae9ff38e7e899834b2fe1b::$classMap;

        }, null, ClassLoader::class);
    }
}
