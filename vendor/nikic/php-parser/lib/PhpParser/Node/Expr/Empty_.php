<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace CoffeeCode\PhpParser\Node\Expr;

use CoffeeCode\PhpParser\Node\Expr;

class Empty_ extends Expr {
    /** @var Expr Expression */
    public Expr $expr;

    /**
     * Constructs an empty() node.
     *
     * @param Expr $expr Expression
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Expr $expr, array $attributes = []) {
        $this->attributes = $attributes;
        $this->expr = $expr;
    }

    public function getSubNodeNames(): array {
        return ['expr'];
    }

    public function getType(): string {
        return 'Expr_Empty';
    }
}
