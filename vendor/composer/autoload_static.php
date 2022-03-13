<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit93bc8e8c2e2906bd1ee21968b4555ccb
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit93bc8e8c2e2906bd1ee21968b4555ccb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit93bc8e8c2e2906bd1ee21968b4555ccb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit93bc8e8c2e2906bd1ee21968b4555ccb::$classMap;

        }, null, ClassLoader::class);
    }
}