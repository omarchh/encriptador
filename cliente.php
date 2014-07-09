<?php
if(isset($argv)){
	array_shift($argv);
	$string_got = implode(" ",$argv);

	//determines the server to connect
	//$host="127.0.0.1";//localhost
	//port used by socket
	//$port=4545;

	$servers = [
	    ['ip'=>"10.0.0.51",'port'=>4545],//Efraim's server
	    ['ip'=>"10.0.0.195",'port'=>8000],//Tonatiuh's server
	    ['ip'=>"10.0.0.152",'port'=>7000],//Roberto's server
	    ['ip'=>"127.0.0.1",'port'=>3535],//Mine's server
	];
	$position = rand(0,count($servers)-1);

	$host = $servers[$position]['ip'];
	$port = $servers[$position]['port'];

	echo $host.' : '.$port."\r\n";

	//Socket creation
	$socket=socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

	//Socket connection
	$conection=socket_connect($socket,$host,$port);

	$buffer_size=2048;//buffer size
	if($conection){
		echo "conection Exitosa a ".$host." : ".$port."\n\n";
		$buffer=$string_got;//Message to display
		$print_exit='';
		//buffer->works with buffer size
		socket_write($socket,$buffer);

		while($print_exit=socket_read($socket,$buffer_size)){
			echo $print_exit."\n";
		}

	}else{
		echo "\n la conexion TCP no se a podido realizar en el puerto: ".$port;
	}
	//Closes the socket
	socket_close($socket);
}else{
	echo "ERROR passing parameters";
}
?>