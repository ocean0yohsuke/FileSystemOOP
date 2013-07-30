<?php
namespace mywork;

class test extends \MethodFileSystemFile
{
	private $var = 0;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print '<br />';
	}
}
