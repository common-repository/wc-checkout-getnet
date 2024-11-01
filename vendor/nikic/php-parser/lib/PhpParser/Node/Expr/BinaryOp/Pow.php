<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace CoffeeCode\PhpParser\Node\Expr\BinaryOp;

use CoffeeCode\PhpParser\Node\Expr\BinaryOp;

class Pow extends BinaryOp {
    public function getOperatorSigil(): string {
        return '**';
    }

    public function getType(): string {
        return 'Expr_BinaryOp_Pow';
    }
}
