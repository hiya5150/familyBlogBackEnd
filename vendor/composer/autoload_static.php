<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit77ce9dc3d3f231e3db47a82ea4703394
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\' => 6,
        ),
        'R' => 
        array (
            'ReallySimpleJWT\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/rbdwllr/reallysimplejwt/tests',
        ),
        'ReallySimpleJWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/rbdwllr/reallysimplejwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit77ce9dc3d3f231e3db47a82ea4703394::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit77ce9dc3d3f231e3db47a82ea4703394::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
