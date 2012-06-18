<?php
class Frend_Authentication {
	var $failed = false;
	var $pass = FREND_PASSWORD;
	var $loggedIn = false;
	var $cookieName = 'frendauth';

	function __construct() {
		return $this->isLoggedIn();
	}

	public function login($userPass)
	{
		if (md5($userPass) == $this->pass) {
			if ($this->createCookie() ) {
				$this->loggedIn = true;
				$this->redirect();
			}
		}
		$this->failed = true;
		return false;
	}

	public function logOut()
	{
		if (setcookie($this->cookieName, null) ) {
			return true;
		}

		return false;
	}

	public function isLoggedIn()
	{
		if ( (isset($_COOKIE[$this->cookieName]) && $_COOKIE[$this->cookieName] == $this->pass) 
			  || $this->loggedIn === true ) {
			return true;
		}

		return false;
	}

	public function redirect() 
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
		if (!$this->isLoggedIn()) {
			$page = '/login.php';			
		} else {
			$page = '/index.php';
		}

		header("Location: " . $host . $uri . $page);
		exit;
	}

	private function createCookie()
	{
		if (setcookie($this->cookieName, $this->pass, time()+3600*24*28, '/') ) {
			return true;
		}

		return false;
	}

}
