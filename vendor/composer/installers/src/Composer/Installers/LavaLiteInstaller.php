<?php
/**
 * @license MIT
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */
namespace CoffeeCode\Composer\Installers;

class LavaLiteInstaller extends BaseInstaller
{
    protected $locations = array(
        'package' => 'packages/{$vendor}/{$name}/',
        'theme'   => 'public/themes/{$name}/',
    );
}
