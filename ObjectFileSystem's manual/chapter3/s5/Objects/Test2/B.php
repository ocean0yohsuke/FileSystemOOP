<?php
namespace Objects\Test2;

class B extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : Test2/B.php <br />';

		$this->B();
	}
}
