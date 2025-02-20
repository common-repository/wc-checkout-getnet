<?php
/**
 * @license MIT
 *
 * Modified by Atanas Angelov on 01-October-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace CoffeeCode\Composer\Pcre\PHPStan;

use CoffeeCode\Composer\Pcre\Preg;
use CoffeeCode\PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Analyser\SpecifiedTypes;
use PHPStan\Analyser\TypeSpecifier;
use PHPStan\Analyser\TypeSpecifierAwareExtension;
use PHPStan\Analyser\TypeSpecifierContext;
use PHPStan\Reflection\MethodReflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Constant\ConstantArrayType;
use PHPStan\Type\Php\RegexArrayShapeMatcher;
use PHPStan\Type\StaticMethodTypeSpecifyingExtension;
use PHPStan\Type\TypeCombinator;
use PHPStan\Type\Type;

final class PregMatchTypeSpecifyingExtension implements StaticMethodTypeSpecifyingExtension, TypeSpecifierAwareExtension
{
    /**
     * @var TypeSpecifier
     */
    private $typeSpecifier;

    /**
     * @var RegexArrayShapeMatcher
     */
    private $regexShapeMatcher;

    public function __construct(RegexArrayShapeMatcher $regexShapeMatcher)
    {
        $this->regexShapeMatcher = $regexShapeMatcher;
    }

    public function setTypeSpecifier(TypeSpecifier $typeSpecifier): void
    {
        $this->typeSpecifier = $typeSpecifier;
    }

    public function getClass(): string
    {
        return Preg::class;
    }

    public function isStaticMethodSupported(MethodReflection $methodReflection, StaticCall $node, TypeSpecifierContext $context): bool
    {
        return in_array($methodReflection->getName(), ['match', 'isMatch', 'matchStrictGroups', 'isMatchStrictGroups'], true) && !$context->null();
    }

    public function specifyTypes(MethodReflection $methodReflection, StaticCall $node, Scope $scope, TypeSpecifierContext $context): SpecifiedTypes
    {
        $args = $node->getArgs();
        $patternArg = $args[0] ?? null;
        $matchesArg = $args[2] ?? null;
        $flagsArg = $args[3] ?? null;

        if (
            $patternArg === null || $matchesArg === null
        ) {
            return new SpecifiedTypes();
        }

        $flagsType = PregMatchFlags::getType($flagsArg, $scope);
        if ($flagsType === null) {
            return new SpecifiedTypes();
        }

        $matchedType = $this->regexShapeMatcher->matchExpr($patternArg->value, $flagsType, TrinaryLogic::createFromBoolean($context->true()), $scope);
        if ($matchedType === null) {
            return new SpecifiedTypes();
        }

        if (
            in_array($methodReflection->getName(), ['matchStrictGroups', 'isMatchStrictGroups'], true)
            && count($matchedType->getConstantArrays()) === 1
        ) {
            $matchedType = $matchedType->getConstantArrays()[0];
            $matchedType = new ConstantArrayType(
                $matchedType->getKeyTypes(),
                array_map(static function (Type $valueType): Type {
                    return TypeCombinator::removeNull($valueType);
                }, $matchedType->getValueTypes()),
                $matchedType->getNextAutoIndexes(),
                [],
                $matchedType->isList()
            );
        }

        $overwrite = false;
        if ($context->false()) {
            $overwrite = true;
            $context = $context->negate();
        }

        return $this->typeSpecifier->create(
            $matchesArg->value,
            $matchedType,
            $context,
            $overwrite,
            $scope,
            $node
        );
    }
}
