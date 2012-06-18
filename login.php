<?php
	require_once('config.php');
	require_once('includes/class.auth.php');
	$auth = new Frend_Authentication();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
		$auth->login($_POST['password']);
	}
?><!doctype html>
<html>
<head>
	<style type="text/css">
		html, body {
			height: 100%;
			width: 100%;
			background: #333;
			padding: 0;
			margin: 0;
			overflow: hidden;
		}
		
		body {
			display: table;
		}
		
		form {
			display: table-cell;
			vertical-align: middle;		
			text-align: center;
			width: 100%;
		}
		
		fieldset {
			border-radius: 2px;
			background: #f5f5f5;
			padding: 1.5em;
			border: none;		
			margin: 0 auto;
			width: 404px;
			box-shadow: 5px 5px 25px 1px rgba(0, 0, 0, 0.5);
			-webkit-box-shadow: 5px 5px 25px 1px rgba(0, 0, 0, 0.5);
		}
		
		input {
			font-size: 2em;
			float: left;
			height: 48px;
			padding: 4px;
			border: 1px solid  rgba(0, 0, 0, 0.25);
			border-radius: 2px;	
			display: block;
			line-height: 1;		
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			box-shadow: 0 1px 0 rgba(0, 0, 0, 0.08), inset 0 1px 2px rgba(255, 255, 255, 0.9);			
		}
		
		input[type="password"] {
			width: 260px;
			margin-right: 0.5em;
		}
		
		input[type="submit"] {
			width: 128px;
			background-image: -webkit-linear-gradient(#EDEDED, #EDEDED 38%, #DEDEDE);
			background-image: -moz-linear-gradient(#EDEDED, #EDEDED 38%, #DEDEDE);
			color: #444;
			text-shadow: 0 1px 0 #F0F0F0;
			font-weight: 900;
			float: left;
			display: block;
			text-align: center;   
	    	font-family: Helvetica, sans-serif;
		}
		
		/*
		Animate.css - http://daneden.me/animate
		LICENSED UNDER THE  MIT LICENSE (MIT)
		
		Copyright (c) 2012 Dan Eden
		
		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
		
		The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
		
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
		*/
		
		.error {
			-webkit-animation-fill-mode: both;
			-moz-animation-fill-mode: both;
			-ms-animation-fill-mode: both;
			-o-animation-fill-mode: both;
			animation-fill-mode: both;
			-webkit-animation-duration: 0.5s;
			-moz-animation-duration: 0.5s;
			-ms-animation-duration: 0.5s;
			-o-animation-duration: 0.5s;
			animation-duration: 0.5s;
			-webkit-animation-name: shake;
			-moz-animation-name: shake;
			-ms-animation-name: shake;
			-o-animation-name: shake;
			animation-name: shake;			
		}
		
		@-webkit-keyframes shake {
			0%, 100% {-webkit-transform: translateX(0);}
			20%, 60% {-webkit-transform: translateX(-15px);}
			40%, 80% {-webkit-transform: translateX(15px);}
		}
		
		@-moz-keyframes shake {
			0%, 100% {-moz-transform: translateX(0);}
			20%, 60% {-moz-transform: translateX(-15px);}
			40%, 80% {-moz-transform: translateX(15px);}
		}
		
		@-ms-keyframes shake {
			0%, 100% {-ms-transform: translateX(0);}
			20%, 60% {-ms-transform: translateX(-15px);}
			40%, 80% {-ms-transform: translateX(15px);}
		}
		
		@-o-keyframes shake {
			0%, 100% {-o-transform: translateX(0);}
			20%, 60% {-o-transform: translateX(-15px);}
			40%, 80% {-o-transform: translateX(15px);}
		}
		
		@keyframes shake {
			0%, 100% {transform: translateX(0);}
			20%, 60% {transform: translateX(-15px);}
			40%, 80% {transform: translateX(15px);}
		}
		
	</style>
	
	<title>Frend login</title>
</head>

<body>
	<form action="login.php" method="post" class="<?= $auth->failed ? "error" : "" ?>">
		<fieldset>
			<input type="password" name="password" placeholder="password" />
			<input type="submit" name="submit" value="Login" />		
		</fieldset>
	</form>
</body>
</html>