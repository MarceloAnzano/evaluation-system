<?php 
class Security {
	var $system = '';
	function setAccess() {
		if (defined('YOURASS'))
			$this->system = 'good';
	}
	
	function getAccess() {
		return $this->system;
	}
}


?>
