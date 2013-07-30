<?php
namespace chainMethods;

class callEnd extends base
{
	function main($string)
	{
		$this->chain_var .= $string;
		
		print $this->chain_var;
	}
}
?>