<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6c65b7bf8f748a780938e3b8253c7e59
{
    public static $files = array (
        'e471bf351add62873bc0289ccd6a937f' => __DIR__ . '/..' . '/league/plates/src/Template/match.php',
        '152c98af9456eeb8f53697d6a7dfd689' => __DIR__ . '/..' . '/league/plates/src/Extension/Data/data.php',
        'e20239a76b73b9912f51f0005956d1db' => __DIR__ . '/..' . '/league/plates/src/Extension/Path/path.php',
        'd513f8e004e152493580ca1917e308ba' => __DIR__ . '/..' . '/league/plates/src/Extension/RenderContext/func.php',
        '27980683f1626a3fd1405d27b171c0fe' => __DIR__ . '/..' . '/league/plates/src/Extension/RenderContext/render-context.php',
        'bdc465a053da7f7ddb072631f6d41d45' => __DIR__ . '/..' . '/league/plates/src/Extension/LayoutSections/layout-sections.php',
        'afa76803f24616d7599be3b7b0846adc' => __DIR__ . '/..' . '/league/plates/src/Extension/Folders/folders.php',
        '16c5be35e32c6cf916d875518b909210' => __DIR__ . '/..' . '/league/plates/src/Util/util.php',
        '6a5f5a8c0fbd8129eb815b8c14d57974' => __DIR__ . '/../..' . '/source/Config/Config.php',
        '5bb244004f16057f855359b9934d72e3' => __DIR__ . '/../..' . '/source/Config/Helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WebPConvert\\' => 12,
        ),
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'MatthiasMullie\\PathConverter\\' => 29,
            'MatthiasMullie\\Minify\\' => 22,
        ),
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
        'I' => 
        array (
            'ImageMimeTypeGuesser\\' => 21,
        ),
        'C' => 
        array (
            'CoffeeCode\\Uploader\\' => 20,
            'CoffeeCode\\Router\\' => 18,
            'CoffeeCode\\Paginator\\' => 21,
            'CoffeeCode\\Optimizer\\' => 21,
            'CoffeeCode\\Cropper\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WebPConvert\\' => 
        array (
            0 => __DIR__ . '/..' . '/rosell-dk/webp-convert/src',
        ),
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'MatthiasMullie\\PathConverter\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/path-converter/src',
        ),
        'MatthiasMullie\\Minify\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/minify/src',
        ),
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
        'ImageMimeTypeGuesser\\' => 
        array (
            0 => __DIR__ . '/..' . '/rosell-dk/image-mime-type-guesser/src',
        ),
        'CoffeeCode\\Uploader\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/uploader/src',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
        'CoffeeCode\\Paginator\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/paginator/src',
        ),
        'CoffeeCode\\Optimizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/optimizer/src',
        ),
        'CoffeeCode\\Cropper\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/cropper/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6c65b7bf8f748a780938e3b8253c7e59::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6c65b7bf8f748a780938e3b8253c7e59::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6c65b7bf8f748a780938e3b8253c7e59::$classMap;

        }, null, ClassLoader::class);
    }
}
