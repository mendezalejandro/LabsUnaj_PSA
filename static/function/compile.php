<?php

    $check = $_POST['checkUpdate'];


        $phpFileUploadErrores = array(
            0 => 'There is no error, the file uploaded with sucess',
            1 => 'The uploaded file exceeds the upload_max filesize directive in php.ini',
            2 => 'The uplodad file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'Archivo no seleccionado',
            6 => 'Missing a temporaly folder',
            7 => 'Failed to write file to disk',
            8 => 'A PHP extension stopped the file upload.',
        );


        $ext_error = false;
        $extensions = array('ino','cpp'); //Extensiones validas
        $file_ext = explode('.', $_FILES['userfile']['name']); 
        $file_ext = end($file_ext); 
        $dir = "/var/www/html/static/function/project/src/";  //Direccion a enviar el archivo
        $ruta_carga = $dir . $_FILES['userfile']['name']; 


        if (!in_array($file_ext, $extensions)) { 

            $ext_error = true;
        }


        $numberError = $_FILES['userfile']['error'];

        
        if($numberError){

            $tipoError = $numberError;
            
            echo $tipoError;

             
        } elseif ($ext_error) {

            echo "9";

        } else {
    
            move_uploaded_file($_FILES['userfile']['tmp_name'], $ruta_carga); //movemos el archivo a la carpeta src
            
                                
            $comando = shell_exec('sh /var/www/html/static/bash/compile.sh'); //Compilamos el archivo.ino mediante la ejecución de un script .sh

            if (strpos($comando, 'SUCCESS') !== false){
    
            if($check=="on"){

                $exe = shell_exec('sh /var/www/html/static/bash/execute.sh');
                shell_exec('sh /var/www/html/static/bash/delete.sh');
                echo "e";


            } else{
                
                echo "c";
                shell_exec('sh /var/www/html/static/bash/delete.sh');
            }

           }else{

                echo "error";
                shell_exec('sh /var/www/html/static/bash/delete.sh');
           }

        }

               # shell_exec('sh /var/www/html/delete.sh');

                
 

        
    
   



?>