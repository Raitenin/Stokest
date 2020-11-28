<?php
$errors = array();

/*--------------------------------------------------------------*/
/* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str)
{
	global $con;
	$escape = mysqli_real_escape_string($con, $str);
	return $escape;
}
/*--------------------------------------------------------------*/
/* Limpa a String de todos os caracteres HTML
/*--------------------------------------------------------------*/
function limpaString($str)
{
	$str = nl2br($str);
	$str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
	return $str;
}

/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validaCampos($var)
{
	global $errors;
	foreach ($var as $field) {
		$val = limpaString($_POST[$field]);
		if (isset($val) && $val == '') {
			$errors = $field . " não pode ser vazio.";
			return $errors;
		}
	}
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg = '')
{
	$output = array();
	if (!empty($msg)) {
		foreach ($msg as $key => $value) {
			$output  = "<div class=\"alert alert-{$key}\">";
			$output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
			$output .= limpaString($value);
			$output .= "</div>";
		}
		return $output;
	} else {
		return "";
	}
}

/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
	if (headers_sent() === false) {
		header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	}

	exit();
}

?>