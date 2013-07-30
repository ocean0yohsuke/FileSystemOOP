<?php
namespace Objects\Test3\A;

class A extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : Test3/A/A.php <br />';
	}
}