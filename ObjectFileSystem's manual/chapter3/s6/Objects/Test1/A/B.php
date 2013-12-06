<?php
namespace Objects\Test1\A;

class B extends \ObjectFileSystemFile
{
	public $var;

        function construct()
        {
                $this->var += 1;

		print $this->var; print ' : construct() in Test1/A/B.php <br />';
        }

	function main()
	{
		$this->var += 1;
		
		print $this->var; print ' : main() in Test1/A/B.php <br />';
	}
}
