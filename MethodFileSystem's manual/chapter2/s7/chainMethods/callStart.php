<?php
namespace chainMethods;

class callStart extends base
{
	function main($string)
	{
		$this->chain_var = $string;
		
		return $this('.');
	}
}
?>