<?php
namespace pack1\pack2; // Postfix '\pack2' has been added

class test2 extends \MethodFileSystemFile
{
	function main()
	{
		print 'test2() has been called successfully.<br />';
		
		// Call test3 from ./pack3
		// Go to ./pack3/test3.php
		$this('pack3')->test3();
	}
}
?>