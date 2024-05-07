<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit358311ca2f6735245eef7f32e8c2eda1
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DankiCode\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DankiCode\\' => 
        array (
            0 => __DIR__ . '/../..' . '/DankiCode',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit358311ca2f6735245eef7f32e8c2eda1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit358311ca2f6735245eef7f32e8c2eda1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit358311ca2f6735245eef7f32e8c2eda1::$classMap;

        }, null, ClassLoader::class);
    }
}
