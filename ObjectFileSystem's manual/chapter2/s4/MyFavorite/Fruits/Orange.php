<?php
namespace MyFavorite\Fruits;

class Orange extends \ObjectFileSystemFile
{
	private $name = 'orange';
	
	function main()
	{
		
	}
	
	function name()
	{
		return $this->name;
	}
}