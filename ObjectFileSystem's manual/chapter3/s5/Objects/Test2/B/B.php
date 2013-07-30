<?php
namespace Objects\Test2\B;

class B extends \ObjectFileSystemFile
{
	public $var;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : Test2/B/B.php <br />';
	}
}