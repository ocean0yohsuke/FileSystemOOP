<?php
namespace MyFavorite;

class Fruits extends \ObjectFileSystemFile
{
	function main()
	{
	}
	
	function getList()
	{
		return array(
			$this->Apple()->name(),
			$this->Orange()->name(),
		);
	}
}
