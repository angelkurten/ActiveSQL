<?php
	require_once('core/lib.php');

	$libs=array('core/active.php', 'core/rest.php');
	import($libs);

	$data = json_encode(array(
	    'q'=> 'John'
	));

	$r=new Rest('', $data);

	echo $r->get();
?>