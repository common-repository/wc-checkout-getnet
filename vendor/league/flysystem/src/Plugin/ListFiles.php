<?php
/**
 * @license MIT
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace CoffeeCode\League\Flysystem\Plugin;

class ListFiles extends AbstractPlugin
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'listFiles';
    }

    /**
     * List all files in the directory.
     *
     * @param string $directory
     * @param bool   $recursive
     *
     * @return array
     */
    public function handle($directory = '', $recursive = false)
    {
        $contents = $this->filesystem->listContents($directory, $recursive);

        $filter = function ($object) {
            return $object['type'] === 'file';
        };

        return array_values(array_filter($contents, $filter));
    }
}
