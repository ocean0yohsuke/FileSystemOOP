<?php
namespace Objects\Test1;

class A extends \ObjectFileSystemFile
{
	public $var;

        function construct()
        {
                $this->var += 1;

		print $this->var; print ' : construct() in Test1/A.php <br />';
        }

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : main() Test1/A.php <br />';

		$this->B();
	}
}
