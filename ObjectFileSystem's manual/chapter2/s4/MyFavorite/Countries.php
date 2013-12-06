<?php
namespace MyFavorite;

class Countries extends \ObjectFileSystemFile
{
	function main()
	{
	}
	
	function getList()
	{
		return array(
			$this->Japan()->name(),
			$this->Taiwan()->name(),
		);
	}
}
