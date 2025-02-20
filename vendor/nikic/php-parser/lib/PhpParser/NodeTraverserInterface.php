<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace CoffeeCode\PhpParser;

interface NodeTraverserInterface {
    /**
     * Adds a visitor.
     *
     * @param NodeVisitor $visitor Visitor to add
     */
    public function addVisitor(NodeVisitor $visitor): void;

    /**
     * Removes an added visitor.
     */
    public function removeVisitor(NodeVisitor $visitor): void;

    /**
     * Traverses an array of nodes using the registered visitors.
     *
     * @param Node[] $nodes Array of nodes
     *
     * @return Node[] Traversed array of nodes
     */
    public function traverse(array $nodes): array;
}
