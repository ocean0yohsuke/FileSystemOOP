<?php 
/*
* Use of private properties
*/

include_once '../../../ObjectFileSystem.php';
$Objects = new ObjectFileSystem('./Objects', 'Objects');
$Objects->make();

// This output 1
$Objects->Test();

// This output 2
$Objects->Test();

// The above example will output:
// 1
// 2
?>
