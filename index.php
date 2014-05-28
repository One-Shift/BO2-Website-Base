<?php
	include "./backoffice/configuration.php";
	include "./backoffice/connect.php";
	include "./backoffice/functions.php";

    	// controlador de páginas
    	if (isset($_GET["pg"]) && !empty($_GET["pg"])) {
        	$pg = $_GET["pg"];
    	} else {
        	$pg = "home";
    	}
    
	// controlador de língua
	if (isset($_GET["lg"]) && !empty($_GET["lg"])) {
		switch ($_GET["lg"]) {
			case "pt": $lg = 1; $lg_s = "pt"; break;
			default: $lg = 1; $lg_s = "pt";
		}
	} else {
		$lg = 1;
		$lg_s = "pt";
	}
    
    	include sprintf("./languages/%s.php", $lg_s);
    
	/*
	 *  abaixo é iniciada a criação do template, com base nós ficheiros html
	 */

	$head = str_replace(
		array("{c2r-sitename}", "{c2r-keywords}", "{c2r-description}", "{c2r-analytics}"), 
		array($configuration["site-name"], $language["system"]["keywords"], $language["system"]["description"], $configuration["analytics"]), 
		file_get_contents("./templates-e/head.html"));
    	$template = "<html><head>{c2r-head}</head><body>{c2r-content}</body></html>";
    
    	include "./pages/includes.php";

 	// print website
    	print str_replace(
	    	array( "{c2r-path}", "{c2r-head}", "{c2r-content}", "{c2r-sitename}", "{c2r-keywords}", "{c2r-description}"),
	    	array( $configuration["path"], $head, $content, $configruation["site-name"], $language["system"]["keywords"], $language["system"]["description"]),
	    	$template
	);
?>
