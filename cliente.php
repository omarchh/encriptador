<?php
array_shift($argv);
$string_got = implode(" ",$argv);


//especificamos el servidor al cual se va a acceder
$host="127.0.0.1";//localhost
//puerto de comunicacion que usara el socket
$puerto=4545;

$servers = [
    ['ip'=>"127.0.0.1",'port'=>4545],
    ['ip'=>"127.0.0.1",'port'=>4545],
    ['ip'=>"127.0.0.1",'port'=>4545],
    ['ip'=>"127.0.0.1",'port'=>4545],
];
$position = rand(0,count($servers)-1);

$host = $servers[$position]['ip'];
$puerto = $servers[$position]['port'];

echo $host.' : '.$puerto."\r\n";

//Creacion del socket
$socket=socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

//creamos una conexion de socket
$conexion=socket_connect($socket,$host,$puerto);

$tamaño=2048;//tamaño del buffer
if($conexion){
echo "Conexion Exitosa a ".$host." : ".$puerto."\n\n";
$buffer=$string_got; //Mensaje a enviar al servidor
$salida='';
//buffer->trabaja con almacenamiento de memoria
socket_write($socket,$buffer);

while($salida=socket_read($socket,$tamaño)){
echo $salida;
}

}else{
echo "\n la conexion TCP no se a podido realizar, puerto: ".$puerto;
}

socket_close($socket); //cierra el recurso socket dado por $socket
?>