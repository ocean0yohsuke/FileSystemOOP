<?php
namespace pack1;

class test1 extends \MethodFileSystemFile
{
	function main()
	{
		print 'test1() has been called successfully.<br />';
		
		// Call test2() from ./pack2
		// Go to ./pack2/test2.php
		$this('pack2')->test2();
	}
}
?>