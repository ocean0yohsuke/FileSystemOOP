<?php 
/*
 * Use of public properties (2)
 */

include_once '../../../ObjectFileSystem.php';
$Objects = new ObjectFileSystem('./Objects', 'Objects');
$Objects->var = 0;
$Objects->make();

$Objects->Test1();
// Public property will be referenced. 
print $Objects->var; print ' : index.php <br />';
print '<br />';

$Objects->var = 0;
$Objects->make();

$Objects->Test2();
// Public property will be referenced successfully. 
print $Objects->var; print ' : index.php <br />';
print '<br />';

$Objects->var = 0;
$Objects->make();

$Objects->Test3();
// Private property will Not be referenced. 
print $Objects->var; print ' : index.php <br />';
print '<br />';

$Objects->var = 0;
$Objects->make();

// The above example will output:
// 1 : Test1.php
// 2 : Test1/A.php
// 3 : Test1/A/A.php
// 3 : index.php 
//
// 1 : Test2.php
// 2 : Test2/A.php
// 3 : Test2/A/A.php
// 4 : Test2/B.php
// 5 : Test2/B/B.php
// 5 : index.php
// 
// 1 : Test3.php
// 1 : Test3/A.php
// 2 : Test3/A/A.php
// 1 : index.php 
//
?>
