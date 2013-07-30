<?php 
/*
 * Use of public properties
 */

include_once '../../../ObjectFileSystem.php';
$Objects = new ObjectFileSystem('./Objects', 'Objects');

// Define a global public property
$Objects->var1 = 'Hello world!';

// Run make() here 
$Objects->make();

print $Objects->Public_()->var1(); print '<br />';

print $Objects->NotPublic()->var1(); print '<br />';

// The above example will output:
// 'Hello world!'
//
?>
