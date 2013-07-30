<?php
namespace Objects;

class Test extends \ObjectFileSystemFile
{
	private $var = 0;

	function main()
	{
		$this->var += 1;
		
		print $this->var; print '<br />';
	}
}
