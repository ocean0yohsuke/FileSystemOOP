<?php
namespace Objects\Test1\A;

class A extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : Test1/A/A.php <br />';
	}
}