<?php
/**
 * @license MIT
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */
namespace CoffeeCode\Composer\Installers;

class RedaxoInstaller extends BaseInstaller
{
    protected $locations = array(
        'addon'          => 'redaxo/include/addons/{$name}/',
        'bestyle-plugin' => 'redaxo/include/addons/be_style/plugins/{$name}/'
    );
}
