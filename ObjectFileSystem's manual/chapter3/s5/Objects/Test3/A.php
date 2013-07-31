<?php
namespace Objects\Test3;

class A extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : Test3/A.php <br />';

		$this->A();
	}
}