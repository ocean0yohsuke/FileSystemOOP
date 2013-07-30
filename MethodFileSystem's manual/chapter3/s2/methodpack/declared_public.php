<?php
namespace mywork;

class declared_public extends \MethodFileSystemFile
{
	// Any public property declared here will load a value from invoker's public property automatically 
	public $var1;
	
	function main()
	{
		// output 'Hello world.'
		var_export($this->var1);
		
		$this->var1 = 'Property var1 was altered.';
	}
}
