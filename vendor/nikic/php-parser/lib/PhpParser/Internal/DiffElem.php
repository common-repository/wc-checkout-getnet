<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace CoffeeCode\PhpParser\Internal;

/**
 * @internal
 */
class DiffElem {
    public const TYPE_KEEP = 0;
    public const TYPE_REMOVE = 1;
    public const TYPE_ADD = 2;
    public const TYPE_REPLACE = 3;

    /** @var int One of the TYPE_* constants */
    public int $type;
    /** @var mixed Is null for add operations */
    public $old;
    /** @var mixed Is null for remove operations */
    public $new;

    /**
     * @param int $type One of the TYPE_* constants
     * @param mixed $old Is null for add operations
     * @param mixed $new Is null for remove operations
     */
    public function __construct(int $type, $old, $new) {
        $this->type = $type;
        $this->old = $old;
        $this->new = $new;
    }
}
