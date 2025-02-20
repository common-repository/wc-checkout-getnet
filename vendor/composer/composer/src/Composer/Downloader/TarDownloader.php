<?php
/**
 * @license MIT
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoffeeCode\Composer\Downloader;

use CoffeeCode\Composer\Package\PackageInterface;
use CoffeeCode\React\Promise\PromiseInterface;

/**
 * Downloader for tar files: tar, tar.gz or tar.bz2
 *
 * @author Kirill chEbba Chebunin <iam@chebba.org>
 */
class TarDownloader extends ArchiveDownloader
{
    /**
     * @inheritDoc
     */
    protected function extract(PackageInterface $package, string $file, string $path): PromiseInterface
    {
        // Can throw an UnexpectedValueException
        $archive = new \PharData($file);
        $archive->extractTo($path, null, true);

        return \CoffeeCode\React\Promise\resolve(null);
    }
}
