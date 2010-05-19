<?php

/**
 * A default form button.
 * 
 * @category Forms
 * @package  Europa
 * @author   Trey Shugart <treshugart@gmail.com>
 * @license  (c) 2010 Trey Shugart
 * @link     http://europaphp.org/license
 */
class Europa_Form_Element_Button extends Europa_Form_Element_Input
{
	/**
	 * Renders the reset element.
	 * 
	 * @return string
	 */
	public function toString()
	{
		if (!$this->getAttribute('type')) {
			$this->setAttribute('type', 'button');
		}
		return parent::toString();
	}
}