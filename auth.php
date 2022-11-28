


<?php

	function authenticate(){
		if($_SERVER['PHP_AUTH_USER'] !== 'admin' && $_SERVER['PHP_AUTH_PW'] !== 'admin')
		{
			header('WWW-Authenticate: Basic realm="Admin Authentication"');
			header('HTTP/1.0 401 Unauthorized');
			die ('There was an error');
			exit;
		}
	
	}
	authenticate();
	
?>