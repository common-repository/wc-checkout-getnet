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
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Php\RegexArrayShapeMatcher;
use PHPStan\Type\StaticMethodParameterOutTypeExtension;
use PHPStan\Type\Type;

final class PregMatchParameterOutTypeExtension implements StaticMethodParameterOutTypeExtension
{
    /**
     * @var RegexArrayShapeMatcher
     */
    private $regexShapeMatcher;

    public function __construct(
        RegexArrayShapeMatcher $regexShapeMatcher
    )
    {
        $this->regexShapeMatcher = $regexShapeMatcher;
    }

    public function isStaticMethodSupported(MethodReflection $methodReflection, ParameterReflection $parameter): bool
    {
        return
            $methodReflection->getDeclaringClass()->getName() === Preg::class
            && in_array($methodReflection->getName(), ['match', 'isMatch', 'matchStrictGroups', 'isMatchStrictGroups'], true)
            && $parameter->getName() === 'matches';
    }

    public function getParameterOutTypeFromStaticMethodCall(MethodReflection $methodReflection, StaticCall $methodCall, ParameterReflection $parameter, Scope $scope): ?Type
    {
        $args = $methodCall->getArgs();
        $patternArg = $args[0] ?? null;
        $matchesArg = $args[2] ?? null;
        $flagsArg = $args[3] ?? null;

        if (
            $patternArg === null || $matchesArg === null
        ) {
            return null;
        }

        $flagsType = PregMatchFlags::getType($flagsArg, $scope);
        if ($flagsType === null) {
            return null;
        }

        return $this->regexShapeMatcher->matchExpr($patternArg->value, $flagsType, TrinaryLogic::createMaybe(), $scope);
    }

}
