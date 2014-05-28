<?php
	$page_template = file_get_contents("./templates/home.html");
	
	$header = file_get_contents("./templates-e/header.html");
	$footer = file_get_contents("./templates-e/footer.html");
	
	
	/* last thing */
	$content = str_replace(
		array("{c2r-header}", "{c2r-footer}"),
		array($header, $footer),
		$page_template
	);
