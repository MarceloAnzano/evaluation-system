<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Call_this {
	function getName()
	{
		echo 'my name is rekt';
	}
	
	function getAddress()
	{
		echo 'ball';
	}
	
	function fromSecuredPlace()
	{
		require_once('secured');
	}
		
}
