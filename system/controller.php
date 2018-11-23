<?php
namespace system;

use system\view as View;

class Controller 
{
	
	protected $model;
	protected $view;
	
	function __construct()
	{

		$this->view = new View();
         
	}
	
	// default action
	public function action_index()
	{
		// todo	
	}
}
