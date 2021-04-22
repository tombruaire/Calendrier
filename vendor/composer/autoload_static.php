<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4d22ef1e80582eff84ad661ef81198b8
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Calendar\\' => 9,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Calendar\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Calendar',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4d22ef1e80582eff84ad661ef81198b8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4d22ef1e80582eff84ad661ef81198b8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4d22ef1e80582eff84ad661ef81198b8::$classMap;

        }, null, ClassLoader::class);
    }
}
