<?php
/**
 * @license MIT
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */
namespace CoffeeCode\Composer\Installers;

class UserFrostingInstaller extends BaseInstaller
{
    protected $locations = array(
        'sprinkle' => 'app/sprinkles/{$name}/',
    );
}
