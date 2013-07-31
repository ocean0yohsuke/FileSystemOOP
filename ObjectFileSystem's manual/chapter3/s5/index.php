<?php 
/*
 * Use of private properties
 */

include_once '../../../ObjectFileSystem.php';
$Objects = new ObjectFileSystem('./Objects', 'Objects');
$Objects->var = 1;
$Objects->make();

// This print 
// 2 : Test1.php
// 3 : Test1/A.php
// 4 : Test1/A/A.php
$Objects->Test1();

// This print 4; Public property is referenced. 
print $Objects->var; print ' : index.php <br />';
print '<br />';

// Refresh $Objects's public property
$Objects->var = 1;
$Objects->make();

// This print
// 2 : Test2.php
// 3 : Test2/A.php
// 4 : Test2/A/A.php
// 5 : Test2/B.php
// 6 : Test2/B/B.php 
$Objects->Test2();

// This print 6; Public property is referenced successfully. 
print $Objects->var; print ' : index.php <br />';
print '<br />';

// Refresh $Objects's public property
$Objects->var = 1;
$Objects->make();

// This print
// 1 : Test3.php
// 1 : Test3/A.php
// 2 : Test3/A/A.php 
$Objects->Test3();

// This print 1; Public property, but which isn't defined as 'public $var;' explicitly in the next class of object, is NOT referenced. 
print $Objects->var; print ' : index.php <br />';
print '<br />';

// The above example will output:
// 2 : Test1.php
// 3 : Test1/A.php
// 4 : Test1/A/A.php
// 4 : index.php 
//
// 2 : Test2.php
// 3 : Test2/A.php
// 4 : Test2/A/A.php
// 5 : Test2/B.php
// 6 : Test2/B/B.php
// 6 : index.php
// 
// 1 : Test3.php
// 1 : Test3/A.php
// 2 : Test3/A/A.php  
?>