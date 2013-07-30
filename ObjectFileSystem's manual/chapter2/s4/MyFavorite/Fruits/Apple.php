<?php
namespace MyFavorite\Fruits;

class Apple extends \ObjectFileSystemFile
{
	private $name = 'apple';
	
	function main()
	{
		
	}
	
	function name()
	{
		return $this->name;
	}
}