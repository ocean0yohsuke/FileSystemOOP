<?php
namespace Objects;

class NotPublic extends \ObjectFileSystemFile
{
	// This public property will be 'NULL' since has not been declared public
	//public $var1;
	
	function main()
	{
	}
	
	function var1()
	{
		return @$this->var1;
	}
	
}
