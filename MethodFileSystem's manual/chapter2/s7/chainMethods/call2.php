<?php
namespace chainMethods;

class call2 extends base
{
	function main()
	{
		$this->chain_var .= ' two,';
		
		return $this('.');
	}
}
?>