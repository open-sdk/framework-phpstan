<?php

namespace OpenSdk\PhpStan\Type;

use OpenSdk\Resource\Manager;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;
use PhpParser\Node\Expr\MethodCall;

class ResourceManagerAsModelDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
	/**
	 * {@inheritdoc}
	 */
	public function getClass(): string
	{
		return Manager::class;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isMethodSupported(MethodReflection $reflection): bool
	{
		return $reflection->getName() === 'asModel';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTypeFromMethodCall(MethodReflection $reflection, MethodCall $call, Scope $scope): Type
	{
		if (count($call->args) === 0) {
			return $reflection->getReturnType();
		}

		return $scope->getType(
			$call->args[0]->value
		);
	}
}
