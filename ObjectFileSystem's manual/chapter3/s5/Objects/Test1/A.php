<?php
namespace Objects\Test1;

class A extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : Test1/A.php <br />';

		$this->A();
	}
}