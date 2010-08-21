<?php

class Test_Route_Named extends Europa_Unit_Test
{
	public function setUp()
	{
		
	}
	
	public function testMatch()
	{
		$route = new Europa_Route_Named(':controller/:action');
		return $route->query('some-controller/some-action') !== false;
	}
	
	public function testNonMatch()
	{
		$route = new Europa_Route_Named(':controller/:action');
		return $route->query('some-controller/some-action/some-parameter') === false;
	}
	
	public function testWildcardWithSlash()
	{
		$route = new Europa_Route_Named(':controller/:action/*');
		return $route->query('some-controller/some-action/') !== false
		    && $route->query('some-controller/some-action/some/other/stuff') !== false;
	}
	
	public function testWildcardWithoutSlash()
	{
		$route = new Europa_Route_Named(':controller/:action*');
		return $route->query('some-controller/some-action') !== false
		    && $route->query('some-controller/some-action/some/other/stuff') !== false;;
	}
	
	public function testRequireEndingSlash()
	{
		$route = new Europa_Route_Named(':controller/:action/');
		return $route->query('some-controller/some-action') === false;
	}
	
	public function testParameterBinding()
	{
		$route  = new Europa_Route_Named(':controller/:action');
		$params = $route->query('test-controller/test-action');
		
		if (!$params) {
			return false;
		}
		
		return $params['controller'] === 'test-controller'
		    && $params['action']     === 'test-action';
	}
	
	public function testDefaultParameterBinding()
	{
		$route = new Europa_Route_Named(
			'user/:user',
			array(
				'controller' => 'test-controller',
				'action'     => 'test-action'
			)
		);
		$params = $route->query('user/testuser');
		
		if (!$params) {
			return false;
		}
		
		return $params['controller'] === 'test-controller'
		    && $params['action']     === 'test-action';
	}
	
	public function testReverseEngineering()
	{
		$route = new Europa_Route_Named('user/:username');
		return $route->reverse(array('username' => 'testuser')) === 'user/testuser';
	}
	
	public function tearDown()
	{
		
	}
}