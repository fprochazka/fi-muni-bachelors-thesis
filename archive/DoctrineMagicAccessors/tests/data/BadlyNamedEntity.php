<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace KdybyTests\Doctrine\MagicAccessors;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @method setTwo()
 * @method addTwo()
 * @method getTwo()
 * @method removeTwo()
 * @method hasTwo()
 * @method \Doctrine\Common\Collections\ArrayCollection getTwos()
 * @method addProxy()
 * @method hasProxy()
 * @method removeProxy()
 * @method \Doctrine\Common\Collections\ArrayCollection getProxies()
 */
class BadlyNamedEntity
{

	use \Kdyby\Doctrine\MagicAccessors\MagicAccessors;

	/**
	 * @var object
	 */
	private $one;

	/**
	 * @var object
	 */
	protected $two;

	/**
	 * @var object
	 */
	protected $four;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 */
	protected $buses;

	/**
	 * @var object
	 */
	public $three;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 */
	private $ones;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 */
	protected $twos;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 */
	protected $proxies;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 */
	public $threes;

	/**
	 * @var int
	 */
	protected $something = 2;

	public function __construct()
	{
		$this->one = (object) ['id' => 1];
		$this->two = (object) ['id' => 2];
		$this->three = (object) ['id' => 3];

		$this->ones = new ArrayCollection([(object) ['id' => 1]]);
		$this->twos = new ArrayCollection([(object) ['id' => 2]]);
		$this->proxies = new ArrayCollection([(object) ['id' => 3]]);
		$this->threes = new ArrayCollection([(object) ['id' => 4]]);

		$this->buses = new ArrayCollection();
	}

	/**
	 * @param int $something
	 */
	public function setSomething($something)
	{
		$this->something = (int) ceil($something / 2);
	}

	/**
	 * @return int
	 */
	public function getSomething()
	{
		return $this->something * 2;
	}

	/**
	 * @return int
	 */
	public function getRealSomething()
	{
		return $this->something;
	}

}
