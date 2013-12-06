<?php
namespace Objects;

class Test1 extends \ObjectFileSystemFile
{
	public $var;

        function construct()
        {
                $this->var += 1;

		print $this->var; print ' : construct() in Test1.php <br />';
        }

	function main()
	{
		$this->var += 1;
 
		print $this->var; print ' : main() in Test1.php <br />';

                $this->A();
	}
}
