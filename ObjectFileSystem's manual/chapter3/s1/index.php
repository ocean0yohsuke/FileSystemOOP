<?php 
/*
* Use of parameters
*/

include_once '../../../ObjectFileSystem.php';
$Objects = new ObjectFileSystem('./Objects', 'Objects');
$Objects->make();

// output 'Hello world!<br />'
$Objects->Output('Hello world')->run();

// output 'HELLO WORLD!<br />'
$str_to_upper = TRUE;
$Objects->Output('Hello world', $str_to_upper)->run();

//The above example will output:
//Hello world!
//HELLO WORLD!
//
?>
