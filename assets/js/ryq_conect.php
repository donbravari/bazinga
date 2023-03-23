<?php
// Create connection
//$GLOBALS['conn'] = mysqli_connect($servername, $username, $password, $bd);

//$GLOBALS['conn'] = mysqli_connect($servername, $username, $password, $bd);
/*$conn = mysqli_init();

mysqli_ssl_set($conn,NULL,NULL, "/var/www/html/DigiCertGlobalRootG2.crt.pem", NULL, NULL);

// Establish the connection
$GLOBALS['conn'] = mysqli_real_connect($conn, $servername, $username, $password, $bd, 3306, NULL, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
  writelog("Error: No se pudo conectar a MySQL." . PHP_EOL);
   writelog("errno de depuración: " . mysqli_connect_errno() . PHP_EOL);
  echo ("Error: No se pudo conectar a MySQL." . $conn->connect_error);
    exit;
}else{
  $GLOBALS['conn'] = $conn;
  writelog("Éxito: Se realizó una conexión apropiada a MySQL" . PHP_EOL);
  echo 'Base de datos conectada';
  $conn->set_charset("utf8");
}



if (!$conn) {
   writelog("Error: No se pudo conectar a MySQL." . PHP_EOL);
   writelog("errno de depuración: " . mysqli_connect_errno() . PHP_EOL);
   writelog("error de depuración: " . mysqli_connect_error() . PHP_EOL);
    exit;
}else{
    writelog("Éxito: Se realizó una conexión apropiada a MySQL" . PHP_EOL);
    $conn->set_charset("utf8");
}*/

// Create connection
$servername = "172.16.2.69";
$username = "TrabajaRQUsr";
$password = "Tr484J4Rq2021.#";
$bd = "TrabajaConRQ";
//$GLOBALS['conn'] = mysqli_connect($servername, $username, $password, $bd);
$conn = mysqli_init();

mysqli_ssl_set($conn,NULL,NULL, "/var/www/html/TrabajaConRQ/DigiCertGlobalRootG2.crt.pem", NULL, NULL);

// Establish the connection
mysqli_real_connect($conn, $servername, $username, $password, $bd, 3306, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT );

if (mysqli_connect_errno($conn)) {
  writelog("Error: No se pudo conectar a MySQL." . PHP_EOL);
   writelog("errno de depuración: " . mysqli_connect_error() . PHP_EOL);
  echo ("Error: No se pudo conectar a MySQL." . mysqli_connect_error());
    exit;
}else{
  $GLOBALS['conn'] = $conn;
  writelog("Éxito: Se realizó una conexión apropiada a MySQL" . PHP_EOL);
  echo 'Base de datos conectada';
  $conn->set_charset("utf8");
}


?>