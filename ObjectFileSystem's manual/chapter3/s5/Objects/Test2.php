<?php
namespace Objects;

class Test2 extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : Test2.php <br />';
		
		$this->A();
		
		$this->B();
	}
}
