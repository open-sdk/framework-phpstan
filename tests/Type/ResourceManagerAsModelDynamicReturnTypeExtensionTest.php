<?php

namespace OpenSdk\PhpStan\Tests\Type;

use OpenSdk\PhpStan\Tests\TestCase;
use OpenSdk\PhpStan\Type\ResourceManagerAsModelDynamicReturnTypeExtension as Extension;
use OpenSdk\Resource\Manager;
use OpenSdk\Resource\Object\Model;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PhpParser\Node\Expr\ClassConstFetch;

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
		$type = $this->mockType();

		$reflection = $this->mockMethodReflection('asModel');
		$call = $this->mockMethodCall();
		$scope = $this->mockScope();

		$reflection->method('getReturnType')
			->willReturn($type);

		$this->assertSame($type, (new Extension)->getTypeFromMethodCall($reflection, $call, $scope));
	}

	public function testGetTypeFromMethodCallReturnsScopeGetTypeForArguments()
	{
		/** @var ClassConstFetch */
		$expression = $this->mockNodeExpression();
		$argument = $this->mockNodeArgument($expression);

		$expression->class = Model::class;

		$reflection = $this->mockMethodReflection('asModel');
		$call = $this->mockMethodCall([$argument]);
		$scope = $this->mockScope();

		$reflection->expects($this->never())
			->method('getReturnType');

		/** @var ObjectType */
		$type = (new Extension)->getTypeFromMethodCall($reflection, $call, $scope);

		$this->assertInstanceOf(ObjectType::class, $type);
		$this->assertSame(Model::class, $type->getClassName());
	}
}
