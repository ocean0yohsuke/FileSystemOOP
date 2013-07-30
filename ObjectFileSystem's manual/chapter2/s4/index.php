<?php
/*
 * Use of some methodfiles and many methodpacks
 */

include_once '../../../ObjectFileSystem.php';

$MyFavorite = new ObjectFileSystem('./MyFavorite', 'MyFavorite');
$MyFavorite->make();

$myfavorite_fruit_list = $MyFavorite->Fruits()->getList();
$myfavorite_country_list = $MyFavorite->Countries()->getList();

I_like($myfavorite_fruit_list);
I_like($myfavorite_country_list);

function I_like($list)
{
	print 'I like ';
	$i = 0;
	do {
		print $list[$i];
		if (isset($list[$i+1])) {
			print ' and ';
		} else {
			print '.';
			print '<br />';
		}
		++$i;
	} while (count($list) > $i);
}

//The above example will output:
//I like Japan and Taiwan.
//I like apples and oranges.

?>