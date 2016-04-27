<?php

// OBTER 1 IMAGEM SABENDO O MODULE E ID ASSOCIADO
function getImg ($id, $module) {
	global $configuration, $mysqli;

	$query = sprintf(
		"SELECT * FROM %s_files WHERE type='%s' AND module = '%s' AND id_ass = '%s' LIMIT %s",
		$configuration["mysql-prefix"], "image", $module, $id, 1
	);
	$source = $mysqli->query($query);

	if ($source->num_rows > 0) {
		$data = $source->fetch_assoc();
		return $data;
	} else {
		return FALSE;
	}
}


// OBTER AS IMAGENS SABENDO O MODULE E ID ASSOCIADO
function getImgs ($id, $module) {
	global $configuration, $mysqli;
	$list = [];

	$query = sprintf(
		"SELECT * FROM %s_files WHERE type='%s' AND module = '%s' AND id_ass = '%s'",
		$configuration["mysql-prefix"], "image", $module, $id
	);
	$source = $mysqli->query($query);

	while ($data = $source->fetch_assoc()) {
		array_push($list, $data);
	}

	if (count($list) > 0) {
		return $list;
	} else {
		return FALSE;
	}
}


// OBTER AS IMAGENS SABENDO O MODULE E ID ASSOCIADO E ADICIONANDO FILTROS NO ALT_2
function getImgsFilter ($id, $module, $filter = []) {
	if (count($filter) > 0) {
		global $configuration, $mysqli;
		$list = [];
		$position = 0;
		$query = "";

		$query = sprintf(
			"SELECT * FROM %s_files WHERE type = '%s' AND ",
			$configuration["mysql-prefix"], "image"
		);

		foreach ($filter as $item) {
			if ($position !== 0) {
				$query .= "AND ";
			}

			$item = str_replace(" ", "%", $item);
			$item = "%$item%";

			$query .= sprintf("alt_2 LIKE '%s' ", $item);
			$position++;
		}

		$query .= sprintf("AND module = '%s' AND id_ass = '%s'", $module, $id);
		$source = $mysqli->query($query);

		while ($data = $source->fetch_assoc()) {
			array_push($list, $data);
		}

		if (count($list) > 0) {
			return $list;
		} else {
			return FALSE;
		}
	} else {
		return FALSE;
	}
}

// OBTER 1 DOCUMENTO SABENDO O MODULE E ID ASSOCIADO
function getDoc ($id, $module) {
	global $configuration, $mysqli;

	$query = sprintf(
		"SELECT * FROM %s_files WHERE type='%s' AND module = '%s' AND id_ass = '%s' LIMIT %s",
		$configuration["mysql-prefix"], "document", $module, $id, 1
	);
	$source = $mysqli->query($query);

	if ($source->num_rows > 0) {
		$data = $source->fetch_assoc();
		return $data;
	} else {
		return FALSE;
	}
}

// OBTER OS DOCUMENTOS SABENDO O MODULE E ID ASSOCIADO
function getDocs ($id, $module) {
	global $configuration, $mysqli;
	$list = [];

	$query = sprintf(
		"SELECT * FROM %s_files WHERE type='%s' AND module = '%s' AND id_ass = '%s'",
		$configuration["mysql-prefix"], "document", $module, $id
	);
	$source = $mysqli->query($query);

	while ($data = $source->fetch_assoc()) {
		array_push($list, $data);
	}

	if (count($list) > 0) {
		return $list;
	} else {
		return FALSE;
	}
}

// OBTER OS DOCUMENTOS SABENDO O MODULE E ID ASSOCIADO E ADICIONANDO FILTROS NO ALT_2
function getDocsFilter ($id, $module, $filter = []) {
	if (count($filter) > 0) {
		global $configuration, $mysqli;
		$list = [];
		$position = 0;
		$query = "";

		$query = sprintf(
			"SELECT * FROM %s_documents WHERE type = '%s' AND ",
			$configuration["mysql-prefix"], "document"
		);

		foreach ($filter as $item) {
			if ($position !== 0) {
				$query .= "AND ";
			}

			$item = str_replace(" ", "%", $item);
			$item = "%$item%";

			$query .= sprintf("alt_2 LIKE '%s' ", $item);
			$position++;
		}

		$query .= sprintf("AND module = '%s' AND id_ass = '%s'", $module, $id);
		$source = $mysqli->query($query);

		while ($data = $source->fetch_assoc()) {
			array_push($list, $data);
		}

		if (count($list) > 0) {
			return $list;
		} else {
			return FALSE;
		}
	} else {
		return FALSE;
	}
}
