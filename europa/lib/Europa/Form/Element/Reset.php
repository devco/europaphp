<?php

/**
 * A default form reset button.
 * 
 * @category Form
 * @package  Europa
 * @author   Trey Shugart
 * @license  (c) 2010 Trey Shugart <treshugart@gmail.com>
 * @link     http://europaphp.org/license
 */
class Europa_Form_Element_Reset extends Europa_Form_Element_Button
{
	/**
	 * Renders the reset element.
	 * 
	 * @return string
	 */
	public function __toString()
	{
		$this->type = 'reset';

		if (!$this->value) {
			$this->value = 'Reset';
		}

		return parent::__toString();
	}
}