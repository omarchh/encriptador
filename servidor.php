<?php
	require("crypter.php");
	/*Configuraciones para creacion del socket*/
	$direccion_ip=0;//Si se establece en 0 acepta cualquier conexion de cualquier ip
	$puerto=4545;//No podemos utilizar puertos menores a 1025, estan reservados el sistema.

	//Creacion del socket
	$socket=socket_create(AF_INET,SOCK_STREAM,0);
	
	//socket_bind() vincula el nombre dado en la variable $direccion al socket descrito por la variable $socket.
	//Se asigna el socket, seguido de la ip y al final el puerto.
	socket_bind($socket,$direccion_ip,$puerto);
	 
	//socket_listen() pone al socket indicado por la variable $socket en modo escucha o espera de conexiones entrantes
	socket_listen($socket);


	$tamanio=2048;//tamaño del buffer
	while(true){
		$cliente=socket_accept($socket);
		$buffer=socket_read($cliente, $tamanio); //leemos mensaje del cliente
		
		//Proceso de encriptacion
		$encriptador = new Encrypter();
		$encriptada = $encriptador->crypt($buffer);

		socket_write($cliente, $encriptada); //escribimos el buffer
		socket_close($cliente); //cerramos cliente
	}
	//socket_close=>cierra el recurso socket dado por $socket
	socket_close($socket);
?>