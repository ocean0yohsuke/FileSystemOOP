<?php
/*
* Use of objectfiles as a directory tree
*/

include_once '../../../ObjectFileSystem.php';
$Test = new ObjectFileSystem('./Test', 'Test', TRUE, FALSE);
$Test->make();

$Test->Test1();

//The above example will output:
//Test1 has been called successfully.
//Test2 has been called successfully.
//Test3 has been called successfully.
//
?>
