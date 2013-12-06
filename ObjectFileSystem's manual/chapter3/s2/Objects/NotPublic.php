<?php
namespace Objects;

class NotPublic extends \ObjectFileSystemFile
{
	//public $var1;
	
	function main()
	{
	}
	
	function var1()
	{
		return @$this->var1;
	}
	
}
