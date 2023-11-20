<?php
// include "php_serial.class.php";
include "phpSerialPort/php_serial.class.php";

$key =$_POST['key'];
// $loop = false;

if(isset($key)){

     $serial = new phpSerial();

     // First we must specify the device. This works on both Linux and Windows (if
     // your Linux serial device is /dev/ttyS0 for COM1, etc.)
     //  $serial->deviceSet("/dev/ttyACM1");
   
     $serial->deviceSet("/dev/ttyACM0"); //Poner acá el puerto donde essta conectado el otro arduino.
     
     //ttyUSB0

     // Set for 9600-8-N-1 (no flow control)
     $serial->confBaudRate(9600); //Baud rate: 9600
    // $serial->confParity("none");  //Parity (this is the "N" in "8-N-1")
    // $serial->confCharacterLength(8); //Character length     (this is the "8" in "8-N-1")
   //  $serial->confStopBits(1);  //Stop bits (this is the "1" in "8-N-1")
 //    $serial->confFlowControl("none");
 
     // Then we need to open it
     $serial->deviceOpen();
 

     sleep(10);
     $serial->sendMessage($key);
     
     
     // If you want to change the configuration, the device must be closed.
     //$serial->deviceClose();

     echo "Se ha enviado una señal mediante la tecla "."$key"." a la otra placa de arduino";
         
}

else{

     echo "hay un error";
}

?>