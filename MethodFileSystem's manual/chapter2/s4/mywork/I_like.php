<?php
namespace mywork;

class I_like extends \MethodFileSystemFile
{
	function main()
	{
		$country1 = $this('countries')->Japan();
		$country2 = $this('countries')->Taiwan();

		print "I like {$country1} and {$country2}.<br />";
		
		$fruit1 = $this('fruits')->apple();
		$fruit2 = $this('fruits')->orange();

		print "I like {$fruit1} and {$fruit2}.<br />";
		
	}
}
?>