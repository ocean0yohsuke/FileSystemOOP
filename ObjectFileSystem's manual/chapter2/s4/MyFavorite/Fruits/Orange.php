<?php
namespace MyFavorite\Fruits;

class Orange extends \ObjectFileSystemFile
{
	private $name = 'oranges';
	
	function main()
	{
	}
	
	function name()
	{
		return $this->name;
	}
}
