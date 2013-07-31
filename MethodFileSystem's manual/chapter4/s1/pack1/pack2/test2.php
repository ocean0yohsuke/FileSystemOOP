<?php
namespace pack1\pack2;

class test2 extends \MethodFileSystemFile
{
	function main()
	{
		$this('pack3')->test3();
	}
}
