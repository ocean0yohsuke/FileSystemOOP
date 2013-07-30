<?php
/*
 * Use of setCach()
 */

include_once '../../../ObjectFileSystem.php';
$Test = new ObjectFileSystem('./Test', 'Test');
$Test->make();
$cache = $Test->get_cache();

// print the cached data: a serialized object
var_dump($cache); print '<br />'; print '<br />';

// Normal mode
{
	$time_start = microtime();

	$Test->make();

	$time_end = microtime();

	print ($time_end - $time_start)*10000; print '<br />';
}


// Cache mode
{
	$time_start = microtime();

	$Test->set_cache($cache);
	$Test->make();

	$time_end = microtime();

	print ($time_end - $time_start)*10000; print '<br />';
}

//The above example will output:
//{STRING}
//
//{DECIMAL}
//{DECIMAL}

?>