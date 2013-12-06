<?php 
/*
 * Use of public properties
 */

include_once '../../../ObjectFileSystem.php';
$Objects = new ObjectFileSystem('./Objects', 'Objects');

// define a global public property
$Objects->var1 = 'Hello world!';

// run make() here 
$Objects->make();

// This prints 'Hello world!'.
print $Objects->Public_()->var1();
print '<br />';

// This prints nothing.
print $Objects->NotPublic()->var1();
print '<br />';

// The above example will output:
// 'Hello world!'
//
?>
