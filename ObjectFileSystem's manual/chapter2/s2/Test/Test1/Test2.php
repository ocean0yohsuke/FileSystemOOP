<?php
namespace Test\Test1; // Postfix '\pack2' has been added

class Test2 extends \ObjectFileSystemFile
{
	function main()
	{
		print "Test2 has been called successfully.<br />";
		
		// Call Test3
		// Go to ./Test2/Test3.php
		$this->Test3();
	}
}
?>
