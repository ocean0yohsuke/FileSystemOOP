<?php
namespace Objects\Test2\A;

class A extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : Test2/A/A.php <br />';
	}
}