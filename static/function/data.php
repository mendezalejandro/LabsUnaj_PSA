<?php
include "phpSerialPort/php_serial.class.php";

$baudios =(int)$_POST['baud'];
$seg =(int)$_POST['seg'];

if(!empty($baudios)){

     $serial = new phpSerial();
     // Especificamos el dispositivo.
     $serial->deviceSet("/dev/ttyACM1");
     // Set for 9600-8-N-1 (no flow control)
     $serial->confBaudRate($baudios); //Baud rate: 9600
     $serial->confParity("none");  //Parity (this is the "N" in "8-N-1")
     $serial->confCharacterLength(8); //Character length     (this is the "8" in "8-N-1")
     $serial->confStopBits(1);  //Stop bits (this is the "1" in "8-N-1")
     $serial->confFlowControl("none");
 
     // Abrimos serial port.
     $serial->deviceOpen();

     sleep($seg);//delay, ya que sino se ejecuta el puerto serial vacio
     // Read data
     $read = $serial->readPort();
     echo $read;

     // Cerramos serial port.
     $serial->deviceClose();
         
}

?>