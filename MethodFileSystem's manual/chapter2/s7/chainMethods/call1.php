<?php
namespace chainMethods;

class call1 extends base
{
	function main()
	{
		$this->chain_var .= ' one,';
		
		return $this('.');
	}
}
?>