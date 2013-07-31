<?php
namespace mywork;

class not_declared_public extends \MethodFileSystemFile
{
	//public $var1;
	
	function main()
	{
		// output 'NULL' since $var1 has not been declared public
		@var_export($this->var1);
	}
}
