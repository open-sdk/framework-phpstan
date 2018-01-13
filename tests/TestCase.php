<?php

namespace OpenSdk\PhpStan\Tests;

use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\Type;
use PHPUnit\Framework\MockObject\MockObject as PHPUnitMock;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\MethodCall;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
	/**
	 * Create a fully-mocked method call instance.
	 *
	 * @param Arg[] $params
	 *
	 * @return PHPUnitMock&MethodCall
	 */
	public function mockMethodCall(array $params = []): MethodCall
	{
		$call = $this->createMock(MethodCall::class);
		$call->args = $params;

		return $call;
	}

	/**
	 * Create a fully-mocked method reflection instance.
	 *
	 * @param string|null $name
	 *
	 * @return PHPUnitMock&MethodReflection
	 */
	public function mockMethodReflection(?string $name = null): MethodReflection
	{
		$reflection = $this->createMock(MethodReflection::class);

		if ($name) {
			$reflection->method('getName')
				->willReturn($name);
		}

		return $reflection;
	}

	/**
	 * Create a fully-mocked scope instance.
	 *
	 * @return PHPUnitMock&Scope
	 */
	public function mockScope(): Scope
	{
		return $this->createMock(Scope::class);
	}

	/**
	 * Create a fully-mocked type instance.
	 *
	 * @return PHPUnitMock&Type
	 */
	public function mockType(): Type
	{
		return $this->createMock(Type::class);
	}

	/**
	 * Create a fully-mocked node argument instance.
	 *
	 * @param Expr|null $expression
	 *
	 * @return PHPUnitMock&Arg
	 */
	public function mockNodeArgument(?Expr $expression = null): Arg
	{
		$argument = $this->createMock(Arg::class);

		if ($expression) {
			$argument->value = $expression;
		}

		return $argument;
	}

	/**
	 * Create a fully-mocked node expression instance.
	 *
	 * @return PHPUnitMock&Expr
	 */
	public function mockNodeExpression(): Expr
	{
		return $this->createMock(Expr::class);
	}
}
