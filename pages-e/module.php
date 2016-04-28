<?php

$page_e_template = file_get_contents("templates-e/module.html");

/* last thing */
$page_template = str_replace(
	[
		"{c2r-mod-module}"
	],
	[
		str_replace(
			[
				""
			],
			[
				""
			],
			$page_e_template
		)
	],
	$page_template
);
