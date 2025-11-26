<?php 
# Database connection starts here
$mysqli = new mysqli('localhost','root','','eleko_resort');
	if($mysqli -> connect_error){
		printf ("cannot create database %s\n", $mysqli -> connect_error);
		exit();
	}
# Database connection ends here...


# Sanitize user input
function filteration($data) {
	foreach($data as $key => $value) {
		$value = trim($value);
		$value = stripcslashes($value);
		$value = htmlspecialchars($value);
		$value = strip_tags($value);
		$data[$key] = $value;
	}
	return $data;
}

function selectAll($table) {
	$mysqli = $GLOBALS['mysqli'];
	$res = mysqli_query($mysqli, "SELECT * FROM $table");
	return $res;
}

function select($sql, $values, $datatypes) {
	$mysqli = $GLOBALS['mysqli'];
	if($stmt = mysqli_prepare($mysqli, $sql)) {
		mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
		if(mysqli_stmt_execute($stmt)) {
			$res = mysqli_stmt_get_result($stmt);
			mysqli_stmt_close($stmt);
			return $res;
		}
		else {
			mysqli_stmt_close($stmt);
			die("Query cannot be executed - Select");
		}
	} else {
		die("Query cannot be prepared - Select");
	}
}


function update($sql, $values, $datatypes) {
	$mysqli = $GLOBALS['mysqli'];
	if($stmt = mysqli_prepare($mysqli, $sql)) {
		mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
		if(mysqli_stmt_execute($stmt)) {
			$res = mysqli_stmt_affected_rows($stmt);
			mysqli_stmt_close($stmt);
			return $res;
		}
		else {
			mysqli_stmt_close($stmt);
			die("Query cannot be executed - Update");
		}
	} else {
		die("Query cannot be prepared - Update");
	}
}

function insert($sql, $values, $datatypes) {
	$mysqli = $GLOBALS['mysqli'];
	if($stmt = mysqli_prepare($mysqli, $sql)) {
		mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
		if(mysqli_stmt_execute($stmt)) {
			$res = mysqli_stmt_affected_rows($stmt);
			mysqli_stmt_close($stmt);
			return $res;
		}
		else {
			mysqli_stmt_close($stmt);
			die("Query cannot be executed - Insert");
		}
	} else {
		die("Query cannot be prepared - Insert");
	}
}


function delete($sql, $values, $datatypes) {
	$mysqli = $GLOBALS['mysqli'];
	if($stmt = mysqli_prepare($mysqli, $sql)) {
		mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
		if(mysqli_stmt_execute($stmt)) {
			$res = mysqli_stmt_affected_rows($stmt);
			mysqli_stmt_close($stmt);
			return $res;
		}
		else {
			mysqli_stmt_close($stmt);
			die("Query cannot be executed - Delete");
		}
	} else {
		die("Query cannot be prepared - Delete");
	}
}


# Second Connection option
// $hostname = 'localhost';
// $username = 'root';
// $password = '';
// $db = 'eleko_resort';

// $mysqli = mysqli_connect($hostname, $username, $password, $db);
// if(!$con) {
// 	die("Cannot connect to Database" .mysqli_connect_error());
// }
?>