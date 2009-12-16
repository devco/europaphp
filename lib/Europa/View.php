<?php

/**
 * @file
 * 
 * @package    Europa
 * @subpackage View
 */

/**
 * @class
 * 
 * @name Europa_View
 * @desc Renders view scripts. Used to render both the layout and view in Europa.
 */
class Europa_View extends Europa_Base
{
	const 
		/**
		 * @constant
		 * @exception
		 * 
		 * @name EXCEPTION_VIEW_NOT_FOUND
		 * @desc Thrown when a view could not be found. Does not get thrown until a view is rendered.
		 */
		EXCEPTION_VIEW_NOT_FOUND = 4,
		
		/**
		 * @constant
		 * @exception
		 * 
		 * @name EXCEPTION_HELPER_NOT_FOUND
		 * @desc The exception that is thrown when a helper was called but could not be found.
		 */
		EXCEPTION_HELPER_NOT_FOUND = 5;
	
	protected
		/**
		 * @property
		 * @protected
		 * 
		 * @name _config
		 * @desc Holds the configuration variables.
		 */
		$_config = array(
				'viewPath'   => './app/views',
				'viewSuffix' => 'php',
				'helperPath' => './app/helpers'
			);
	
	private
		/**
		 * @property
		 * @private
		 * 
		 * @name _script
		 * @desc The script that will be rendered. Set using Europa_View::render().
		 */
		$_script = 'index/index';
	
	
	
	/**
	 * @method
	 * @magic
	 * 
	 * @name __call
	 * @desc Loads a helper and executes it. Throws an exception if not found.
	 * 
	 * @return Mixed
	 */
	public function __call($func, $args)
	{
		$class = ucfirst($func) . 'Helper';
		$path  = $this->getConfig('helperPath');
		
		// faster than include/require once
		if (!Europa_Loader::loadClass($class, $path)) {
			Europa_Exception::trigger('Unable to find helper <strong>' . $class . '</strong> in <strong>' . $path . '</strong>.', self::EXCEPTION_HELPER_NOT_FOUND);
		}
		
		// instantiate it, passing the arguments as an array
		$instance = new $class($args);
		
		// call the function with the same name as a helper since __construct doesn't return anything but it's own instance
		return method_exists($class, $func)
			? call_user_func_array(array($instance, $func), $args)
			: $instance;
	}
	
	/**
	 * @method
	 * @magic
	 * 
	 * @name __toString
	 * @desc Returns the contents of the rendered view.
	 * 
	 * @return String
	 */
	public function __toString()
	{
		$path   = $this->getConfig('viewPath');
		$script = $this->_script . '.' . $this->getConfig('viewSuffix');
		$file   = realpath($path . DIRECTORY_SEPARATOR . $script);
		
		// since we can't throw an exception in __toString, we have to trigger one
		if (!is_file($file)) {
			Europa_Exception::trigger('View script <strong>' . $script . '</strong> does not exist in <strong>' . $path . '</strong>.', self::EXCEPTION_VIEW_NOT_FOUND);
		}
		
		// allows us to return the included file as a string
		ob_start();
		
		// include it
		include $file;
		
		// get the output buffer
		$contents = ob_get_clean();
			
		// and return it;
		// the newline character just helps to make the source look better ;)
		return $contents . "\n";
	}
	
	
	
	/**
	 * @method
	 * @public
	 * 
	 * @name render
	 * @desc Sets the script to be rendered.
	 * 
	 * @param String $script - The path to the script to be rendered relative to the view path, excluding the extension.
	 * 
	 * @return Object Europa_View
	 */
	public function render($script)
	{
		$this->_script = $script;
		
		return $this;
	}
}
