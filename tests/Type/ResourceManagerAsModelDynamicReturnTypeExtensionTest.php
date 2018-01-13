<?php

namespace OpenSdk\PhpStan\Tests\Type;

use OpenSdk\PhpStan\Tests\TestCase;
use OpenSdk\PhpStan\Type\ResourceManagerAsModelDynamicReturnTypeExtension as Extension;
use OpenSdk\Resource\Manager;
use OpenSdk\Resource\Object\Model;
use PHPStan\Type\DynamicMethodReturnTypeExtension;

class ResourceManagerAsModelDynamicReturnTypeExtensionTest extends TestCase
{
	public function testIsADynamicMethodReturnTypeExtension()
	{
		$this->assertInstanceOf(DynamicMethodReturnTypeExtension::class, new Extension);
	}

	public function testGetClassReturnsManagerClass()
	{
		$this->assertSame(Manager::class, (new Extension)->getClass());
	}

	public function testIsMethodSupportedReturnsTrueOnlyForAsModel()
	{
		$extension = new Extension;

		$this->assertTrue($extension->isMethodSupported($this->mockMethodReflection('asModel')));
		$this->assertFalse($extension->isMethodSupported($this->mockMethodReflection('asArray')));
		$this->assertFalse($extension->isMethodSupported($this->mockMethodReflection('asCollection')));
	}

	public function testGetTypeFromMethodCallReturnsReflectionGetReturnTypeForNoArguments()
	{
		$reflection = $this->mockMethodReflection('asModel');
		$call = $this->mockMethodCall();
		$type = $this->mockType();
		$scope = $this->mockScope();

		$reflection->method('getReturnType')
			->willReturn($type);

		$scope->expects($this->never())
			->method('getType');

		$this->assertSame($type, (new Extension)->getTypeFromMethodCall($reflection, $call, $scope));
	}

	public function testGetTypeFromMethodCallReturnsScopeGetTypeForArguments()
	{
		$argument = $this->mockNodeArgument(
			$expression = $this->mockNodeExpression()
		);

		$reflection = $this->mockMethodReflection('asModel');
		$call = $this->mockMethodCall([$argument]);
		$type = $this->mockType();
		$scope = $this->mockScope();

		$reflection->expects($this->never())
			->method('getReturnType');

		$scope->method('getType')
			->with($expression)
			->willReturn($type);

		$this->assertSame($type, (new Extension)->getTypeFromMethodCall($reflection, $call, $scope));
	}
}
