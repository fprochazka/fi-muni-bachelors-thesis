<?php

/**
 * @testCase
 */

namespace KdybyTests\Doctrine\MagicAccessors;

use Kdyby\Doctrine\Collections\Readonly\ReadOnlyCollectionWrapper;
use Tester\Assert;

require_once __DIR__ . '/bootstrap.php';

class MagicAccessorsTest extends \Tester\TestCase
{

	public function testUnsetPrivateException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			unset($entity->one);
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Cannot unset the property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$one.');
	}

	public function testUnsetProtectedException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			unset($entity->two);
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Cannot unset the property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$two.');
	}

	public function testIsset()
	{
		$entity = new BadlyNamedEntity();
		Assert::false(isset($entity->one));
		Assert::true(isset($entity->two));
		Assert::true(isset($entity->three));
		Assert::false(isset($entity->ones));
		Assert::true(isset($entity->twos));
		Assert::true(isset($entity->proxies));
		Assert::true(isset($entity->threes));
	}

	public function testGetPrivateException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->one;
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Cannot read an undeclared property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$one.');
	}

	public function testGetProtected()
	{
		$entity = new BadlyNamedEntity();
		Assert::equal(2, $entity->two->id);
	}

	public function testGetPrivateCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->ones;
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Cannot read an undeclared property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$ones.');
	}

	public function testGetProtectedCollection()
	{
		$entity = new BadlyNamedEntity();

		Assert::equal($entity->twos, $entity->getTwos());
		Assert::type(ReadOnlyCollectionWrapper::class, $entity->twos);
		Assert::type(ReadOnlyCollectionWrapper::class, $entity->getTwos());

		Assert::equal($entity->proxies, $entity->getProxies());
		Assert::type(ReadOnlyCollectionWrapper::class, $entity->proxies);
		Assert::type(ReadOnlyCollectionWrapper::class, $entity->getProxies());
	}

	public function testSetPrivateException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->one = 1;
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Cannot write to an undeclared property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$one.');
	}

	public function testSetProtected()
	{
		$entity = new BadlyNamedEntity();
		$entity->two = 2;
		Assert::equal(2, $entity->two);
	}

	public function testSetPrivateCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->ones = 1;
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Cannot write to an undeclared property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$ones.');
	}

	public function testSetProtectedCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->twos = 1;
		}, \Kdyby\Doctrine\MagicAccessors\UnexpectedValueException::class, 'Class property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$twos is an instance of Doctrine\Common\Collections\Collection. Use add<property>() and remove<property>() methods to manipulate it or declare your own.');
	}

	public function testSetProtectedCollection2Exception()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->proxies = 1;
		}, \Kdyby\Doctrine\MagicAccessors\UnexpectedValueException::class, 'Class property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$proxies is an instance of Doctrine\Common\Collections\Collection. Use add<property>() and remove<property>() methods to manipulate it or declare your own.');
	}

	public function testCallSetterOnPrivateException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->setOne(1);
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Call to undefined method KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::setOne().');
	}

	public function testCallSetterOnProtected()
	{
		$entity = new BadlyNamedEntity();
		$entity->setTwo(2);
		Assert::equal(2, $entity->two);
	}

	public function testValidSetterProvidesFluentInterface()
	{
		$entity = new BadlyNamedEntity();
		Assert::same($entity, $entity->setTwo(2));
	}

	public function testCallSetterOnPrivateCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->setOnes(1);
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Call to undefined method KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::setOnes().');
	}

	public function testCallSetterOnProtectedCollection()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->setTwos(2);
		}, \Kdyby\Doctrine\MagicAccessors\UnexpectedValueException::class, 'Class property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$twos is an instance of Doctrine\Common\Collections\Collection. Use add<property>() and remove<property>() methods to manipulate it or declare your own.');
	}

	public function testCallSetterOnProtected2Collection()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->setProxies(3);
		}, \Kdyby\Doctrine\MagicAccessors\UnexpectedValueException::class, 'Class property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$proxies is an instance of Doctrine\Common\Collections\Collection. Use add<property>() and remove<property>() methods to manipulate it or declare your own.');
	}

	public function testCallGetterOnPrivateException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->getOne();
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Call to undefined method KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::getOne().');
	}

	public function testCallGetterOnProtected()
	{
		$entity = new BadlyNamedEntity();
		Assert::equal(2, $entity->getTwo()->id);
	}

	public function testCallGetterOnPrivateCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->getOnes();
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Call to undefined method KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::getOnes().');
	}

	public function testCallGetterOnProtectedCollection()
	{
		$entity = new BadlyNamedEntity();
		Assert::equal([(object) ['id' => 2]], $entity->getTwos()->toArray());
		Assert::equal([(object) ['id' => 3]], $entity->getProxies()->toArray());
	}

	public function testCallNonExistingMethodException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->thousand(1000);
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Call to undefined method KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::thousand().');
	}

	public function testCallAddOnPrivateCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->addOne((object) ['id' => 1]);
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Call to undefined method KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::addOne().');
	}

	public function testCallAddOnNonCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->addFour((object) ['id' => 4]);
		}, \Kdyby\Doctrine\MagicAccessors\UnexpectedValueException::class, 'Class property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$four is not an instance of Doctrine\Common\Collections\Collection.');
	}

	public function testCallAddOnProtectedCollection()
	{
		$entity = new BadlyNamedEntity();
		$entity->addTwo($a = (object) ['id' => 2]);
		Assert::truthy($entity->getTwos()->filter(function ($two) use ($a) {
			return $two === $a;
		}));

		$entity->addProxy($b = (object) ['id' => 3]);
		Assert::truthy((bool) $entity->getProxies()->filter(function ($two) use ($b) {
			return $two === $b;
		}));
	}

	public function testCallHasOnPrivateCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->hasOne((object) ['id' => 1]);
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Call to undefined method KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::hasOne().');
	}

	public function testCallHasOnNonCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->hasFour((object) ['id' => 4]);
		}, \Kdyby\Doctrine\MagicAccessors\UnexpectedValueException::class, 'Class property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$four is not an instance of Doctrine\Common\Collections\Collection.');
	}

	public function testCallHasOnProtectedCollection()
	{
		$entity = new BadlyNamedEntity();
		Assert::false($entity->hasTwo((object) ['id' => 2]));
		Assert::false($entity->hasProxy((object) ['id' => 3]));

		$twos = $entity->getTwos();
		Assert::false($twos->isEmpty());
		Assert::true($entity->hasTwo($twos->first()));

		$proxies = $entity->getProxies();
		Assert::false($proxies->isEmpty());
		Assert::true($entity->hasProxy($proxies->first()));
	}

	public function testCallRemoveOnPrivateCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->removeOne((object) ['id' => 1]);
		}, \Kdyby\Doctrine\MagicAccessors\MemberAccessException::class, 'Call to undefined method KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::removeOne().');
	}

	public function testCallRemoveOnNonCollectionException()
	{
		Assert::exception(function () {
			$entity = new BadlyNamedEntity();
			$entity->removeFour((object) ['id' => 4]);
		}, \Kdyby\Doctrine\MagicAccessors\UnexpectedValueException::class, 'Class property KdybyTests\Doctrine\MagicAccessors\BadlyNamedEntity::$four is not an instance of Doctrine\Common\Collections\Collection.');
	}

	public function testCallRemoveOnProtectedCollection()
	{
		$entity = new BadlyNamedEntity();
		$twos = $entity->getTwos();
		Assert::false($twos->isEmpty());
		$entity->removeTwo($twos->first());
		$twos = $entity->getTwos();
		Assert::true($twos->isEmpty());

		$proxies = $entity->getProxies();
		Assert::false($proxies->isEmpty());
		$entity->removeProxy($proxies->first());
		$proxies = $entity->getProxies();
		Assert::true($proxies->isEmpty());
	}

	public function testGetterHaveHigherPriority()
	{
		$entity = new BadlyNamedEntity();
		Assert::equal(4, $entity->something);
	}

	public function testSetterHaveHigherPriority()
	{
		$entity = new BadlyNamedEntity();
		$entity->something = 4;
		Assert::same(2, $entity->getRealSomething());
	}

	public function testPluralAccessor()
	{
		$entity = new BadlyNamedEntity();
		Assert::false($entity->hasBus(1));

		$entity->addBus(1);
		$entity->addBus(2);
		Assert::true($entity->hasBus(1));

		$entity->removeBus(1);
		Assert::false($entity->hasBus(1));

		Assert::true($entity->hasBus(2));
	}

}

(new MagicAccessorsTest())->run();
