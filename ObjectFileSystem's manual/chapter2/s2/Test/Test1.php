<?php
namespace Test;

class Test1 extends \ObjectFileSystemFile
{
	function main()
	{
		print "Test1'main() has been called successfully.<br />";
		
		// Call Test2'main() 
		// Go to ./Test2/Test3.php
		$this->Test2();
	}
}
?>