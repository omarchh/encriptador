<?php
	//For handle errors in php
	function handleError($errno, $errstr, $errfile, $errline, array $errcontext){
	    // error was suppressed with the @-operator
	    if (0 === error_reporting()) {
	        return false;
	    }
	    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	}
	set_error_handler('handleError');
	//*/

	require("crypter.php");
	/*Socket configs*/
	$ip_direction=0;//With a 0 for any inner connection
	$port=3535;//Can't use lower than 1025 (system ussage)
	//Locator vars
	$locator="127.0.0.1";
	$locator_port=13091;

	/********************************LOCATOR************************************/
	//Socket for locator
	$socket_locator=socket_create(AF_INET,SOCK_STREAM,0);
	//Case of error with connection
	try{
		$locator_con=socket_connect($socket_locator,$locator,$locator_port);
		if($locator_con){
			echo "Conexion Exitosa a locator\n\n";
		}
	}catch(exeption $e){
		echo "No se pudo conectar al servidor Locator\n\n";
		echo "Excepcion: ".$e;
	}
	/******************************LOCATOR END**********************************/

	//Socket creation
	$socket=socket_create(AF_INET,SOCK_STREAM,0);
	//socket_bind() binds the socket with an ip and a port
	socket_bind($socket,$ip_direction,$port);	 
	//socket_listen() sets the socket im listening mode and waits for inner connections
	socket_listen($socket);

	$buffer_size=2048;
	while(true){
		echo "Entro a while\n";
		$client=socket_accept($socket);
		//Reads client message
		$buffer=socket_read($client, $buffer_size);
		//crypting process
		$crypter = new Crypter();
		$crypted = $crypter->crypt($buffer);
		//writes on screen
		socket_write($client, $crypted);
		//Closing client
		socket_close($client);
	}
	//socket_close=> closes designed socket
	socket_close($socket);
?>