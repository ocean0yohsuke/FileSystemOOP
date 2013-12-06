<?php
namespace MyFavorite\Fruits;

class Apple extends \ObjectFileSystemFile
{
	private $name = 'apples';
	
	function main()
	{
	}
	
	function name()
	{
		return $this->name;
	}
}
