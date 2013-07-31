<?php
namespace chainMethods;

class call3 extends base
{
	function main()
	{
		$this->chain_var .= ' three,';
		
		return $this('.');
	}
}
?>