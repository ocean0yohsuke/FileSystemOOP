<?php
namespace pack1;

class test1 extends \MethodFileSystemFile
{
	function main()
	{
		$this('pack2')->test2();
	}
}
