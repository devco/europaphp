<?php

/**
 * The exception class for Europa_Router.
 * 
 * @category Exceptions
 * @package  Europa
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  Copyright (c) 2010 Trey Shugart http://europaphp.org/license
 */
namespace Europa\Router
{
	class Exception extends \Europa\Exception
	{
	    /**
	     * Thrown when no route is matched.
	     * 
	     * @var int
	     */
	    const NO_MATCH = 1;
	}
}