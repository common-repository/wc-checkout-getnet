<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace CoffeeCode\PhpParser\Node\Expr\Cast;

use CoffeeCode\PhpParser\Node\Expr\Cast;

class Double extends Cast {
    // For use in "kind" attribute
    public const KIND_DOUBLE = 1; // "double" syntax
    public const KIND_FLOAT = 2;  // "float" syntax
    public const KIND_REAL = 3; // "real" syntax

    public function getType(): string {
        return 'Expr_Cast_Double';
    }
}
