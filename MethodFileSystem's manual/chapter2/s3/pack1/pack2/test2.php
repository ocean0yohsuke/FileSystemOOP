<?php
class pack1_pack2_test2 extends MethodFileSystemFile
{
	function main()
	{
		print 'test2() has been called successfully.<br />';
		
		// Call test3 from ./pack3
		// Go to ./pack3/test3.php
		$this->__invoke('pack3')->test3();
	}
}
?>