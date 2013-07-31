<?php
class Test_Test1 extends ObjectFileSystemFile
{
	function main()
	{
		print "Test1'main() has been called successfully.<br />";
		
		$this->Test2();
	}
}
?>