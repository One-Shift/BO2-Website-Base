<?php

require 'backoffice/class/PHPMailer/PHPMailerAutoload.php';

include "backoffice/configuration.php";
include "backoffice/connect.php";
include "backoffice/functions.php";
include "pages/functions.php";

// controlador de sessão
if (isset($_COOKIE[$configuration["cookie"]]) && !empty($_COOKIE[$configuration["cookie"]])) {

	$cookie = explode(".", $_COOKIE[$configuration["cookie"]]);

	if (count($cookie) === 2) {
		$cookie[0] = intval($cookie[0]);
		$cookie[1] = $mysqli->real_escape_string($cookie[1]);

		$query[0] = sprintf("SELECT * FROM %s_users WHERE id = '%s' AND password = '%s' LIMIT %s", $configuration["mysql-prefix"], $cookie[0], $cookie[1], 1);
		$source[0] = $mysqli->query($query[0]);
		$nr[0] = $source[0]->num_rows;

		if ($nr[0] === 1) {
			$auth = true;
			$authData = $source[0]->fetch_assoc();
		} else {
			$auth = false;
		}
	}
} else {
	$auth = false;
}

// controlador de páginas
if (isset($_GET["pg"]) && !empty($_GET["pg"])) {
	$pg = $_GET["pg"];
} else {
	$pg = "home";
}

// controlador de língua
if (isset($_GET["lg"]) && !empty($_GET["lg"])) {
	switch ($_GET["lg"]) {
		case "pt":
			$lg = 1;
			$lg_s = "pt";
			break;
		default:
			$lg = 1;
			$lg_s = "pt";
	}
} else {
	$lg = 1;
	$lg_s = "pt";
}

// controlador de ID
if (isset($_GET["i"]) && !empty($_GET["i"])) {
	$id = intval($_GET["i"]);
} else {
	$id = null;
}

// controlador de acção
if (isset($_GET["a"]) && !empty($_GET["a"])) {
	$a = $mysqli->real_escape_string($_GET["a"]);
} else {
	$a = null;
}

$head = file_get_contents("templates-e/head.tpl");

$language = parse_ini_file(sprintf("languages/%s.ini", $lg_s), true);

/*
 *  abaixo é iniciada a criação do template, com base nós ficheiros html
 */

include "pages/includes.php";

// print website
$template = str_replace(
	[
		"{c2r-head}", 
		"{c2r-sitename}", 
		"{c2r-keywords}", 
		"{c2r-description}", 
		"{c2r-analytics}", 
		"{c2r-path}", 
		"{c2r-lg}"
	], 
	[
		str_replace(
			[
				"{c2r-og-title}",
				"{c2r-og-url}",
				"{c2r-og-image}",
				"{c2r-og-description}",

				"{c2r-lib-bootstrap}",
				"{c2r-lib-fontawesome}"
			],
			[
				(isset($og["title"])) ? $og["title"] : $configuration["site-name"],
				(isset($og["url"])) ? $og["url"] : "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
				(isset($og["image"])) ? $og["image"] : "http://".$_SERVER["HTTP_HOST"].$configuration["path"]."/site-assets/default-share-image.jpg",
				(isset($og["description"])) ? $og["description"] : $language["system"]["description"],

				file_get_contents("http://nexus-pt.github.io/BO2/bootstrap.html"),
				file_get_contents("http://nexus-pt.github.io/BO2/fontawesome.html")
			],
			$head
		),
		$configuration["site-name"], 
		$language["system"]["keywords"], 
		$language["system"]["description"],
		$configuration["analytics"], 
		$configuration["path"], 
		$lg_s
	], 
	$template
);

// minify system
if ($configuration["minify"]) {
	print minifyPage($template);
} else {
	print $template;
}
