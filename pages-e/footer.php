<?php
	$page_e_template = file_get_contents("./templates-e/footer.html");

	/* last thing */
	$footer = str_replace( array(), array($header, $footer), $page_e_template);
