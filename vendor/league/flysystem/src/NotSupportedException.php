<?php
/**
 * @license MIT
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace CoffeeCode\League\Flysystem;

use RuntimeException;
use SplFileInfo;

class NotSupportedException extends RuntimeException implements FilesystemException
{
    /**
     * Create a new exception for a link.
     *
     * @param SplFileInfo $file
     *
     * @return static
     */
    public static function forLink(SplFileInfo $file)
    {
        $message = 'Links are not supported, encountered link at ';

        return new static($message . $file->getPathname());
    }

    /**
     * Create a new exception for a link.
     *
     * @param string $systemType
     *
     * @return static
     */
    public static function forFtpSystemType($systemType)
    {
        $message = "The FTP system type '$systemType' is currently not supported.";

        return new static($message);
    }
}
