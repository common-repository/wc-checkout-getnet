<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace CoffeeCode\PhpParser\Node\Scalar\MagicConst;

use CoffeeCode\PhpParser\Node\Scalar\MagicConst;

class File extends MagicConst {
    public function getName(): string {
        return '__FILE__';
    }

    public function getType(): string {
        return 'Scalar_MagicConst_File';
    }
}
