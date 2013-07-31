<?php
class mywork_I_like // 'mywork_' has been prefixed 
	extends MethodFileSystemFile
{
	function main()
	{
		$country1 = $this->__invoke('countries')->Japan();
		$country2 = $this->__invoke('countries')->Taiwan();

		print "I like {$country1} and {$country2}.<br />";
		
		$fruit1 = $this->__invoke('fruits')->apple();
		$fruit2 = $this->__invoke('fruits')->orange();

		print "I like {$fruit1} and {$fruit2}.<br />";
		
	}
}
?>