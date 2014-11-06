<?php
	include "./pages-e/header.php";
	include "./pages-e/footer.php";

	$page_template = file_get_contents("./templates/home.html");

	/* last thing */
	$template = str_replace(
		array("{c2r-header}", "{c2r-footer}"),
		array($header, $footer),
		$page_template
	);
