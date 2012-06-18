<?php
require_once('config.php');
require_once('includes/class.auth.php');
require_once('includes/class.files.php');
$auth = new Frend_Authentication();

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	//its an ajax request
	if ($auth->isLoggedIn()) {
		$fileName = $_POST['file'];
		$content = $_POST['content'];
		
		$files = new Frend_Files($fileName);
		if ($files->save($content)) {
			header('HTTP/1.1 200 OK');
		} else {
			header('HTTP/1.1 500 Internal Server Error');
		}
	} else {
		header('HTTP/1.1 401 Unauthorized');
	}
} else {
	if ($auth->isLoggedIn()) {
		header("Location: /");
	} else {
		$auth->redirect();
	}
}