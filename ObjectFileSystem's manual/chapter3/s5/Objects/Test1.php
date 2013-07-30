<?php
namespace Objects;

class Test1 extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
 
		print $this->var; print ' : Test1.php <br />';
		
		$this->A();
	}
}