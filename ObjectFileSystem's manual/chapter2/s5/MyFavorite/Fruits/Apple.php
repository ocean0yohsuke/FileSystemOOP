<?php

class MyFavorite_Fruits_Apple extends \ObjectFileSystemFile
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
