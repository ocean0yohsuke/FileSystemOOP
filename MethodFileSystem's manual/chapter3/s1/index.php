<?php 
/*
 * Use of parameters
 */

include_once '../../../MethodFileSystem.php';
$methodpack = new MethodFileSystem('./methodpack', 'mywork');
$methodpack->make();

// output 'Hello world.<br />'
$methodpack('.')->output('Hello world.<br />');

// output 'HELLO WORLD.'
$str_to_upper = true;
$methodpack('.')->output('Hello world.', $str_to_upper);

//The above example will output:
//Hello world.
//HELLO WORLD.

?>