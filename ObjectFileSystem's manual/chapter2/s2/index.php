<?php
/*
 * Use of a objectfile from a methodpack
 */

include_once '../../../ObjectFileSystem.php';

$Test = new ObjectFileSystem('./Test', 'Test');
$Test->make();

$Test->Test1();

//The above example will output:
//test1() has been called successfully.
//test2() has been called successfully.
//test3() has been called successfully.
//
//test2() has been called successfully.
//test3() has been called successfully.
?>