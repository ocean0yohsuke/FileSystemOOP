<?php
namespace Objects;

class Test3 extends \ObjectFileSystemFile
{
	//public $var;

	function main()
	{
		$this->var += 1;
 
		print $this->var; print ' : Test3.php <br />';
		
		$this->A();
	}
}