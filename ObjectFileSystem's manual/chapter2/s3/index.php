<?php
/*
 * Use of any objectfile from any MethodPack
 */

include_once '../../../ObjectFileSystem.php';
$Test = new ObjectFileSystem('./Test', 'Test', TRUE, FALSE);
$Test->make();

$Test->Test1();

//The above example will output:
//Test1'main() has been called successfully.
//Test2'main() has been called successfully.
//Test3'main() has been called successfully.
//
?>