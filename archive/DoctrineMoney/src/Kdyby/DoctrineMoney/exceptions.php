<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace Kdyby\DoctrineMoney;


/**
 * @author Filip Procházka <filip@prochazka.su>
 */
interface Exception extends \Kdyby\Money\Exception
{

}



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class CurrenciesConflictException extends \RuntimeException implements Exception
{

}
