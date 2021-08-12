<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc66d211081e08a875c87f214b89e1eaf
{
    public static $files = array (
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '93d17691ed1face31c1932b7b48dfc0a' => __DIR__ . '/..' . '/magnifico/bitrix-migration/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Debug\\' => 24,
            'Symfony\\Component\\Console\\' => 26,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Magnifico\\Migration\\' => 20,
        ),
        'B' => 
        array (
            'Bizprofi\\Tools\\Module\\' => 22,
            'Bizprofi\\Tools\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Debug\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/debug',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Magnifico\\Migration\\' => 
        array (
            0 => __DIR__ . '/..' . '/magnifico/bitrix-migration/src/Migration',
        ),
        'Bizprofi\\Tools\\Module\\' => 
        array (
            0 => __DIR__ . '/..' . '/bizprofi/tools-module/src',
        ),
        'Bizprofi\\Tools\\' => 
        array (
            0 => __DIR__ . '/..' . '/bizprofi/tools-lang/src',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc66d211081e08a875c87f214b89e1eaf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc66d211081e08a875c87f214b89e1eaf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc66d211081e08a875c87f214b89e1eaf::$classMap;

        }, null, ClassLoader::class);
    }
}