<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "static/include/head.php"; ?>
    <?php 
        include 'static/function/api_token_service.php';
        if (isset($_GET['token'])) {
            // Obtiene el valor del parámetro 'nombre'
            $token = $_GET['token'];
        } else {
            echo "	<script type='text/javascript'>
                window.location='access-denied.php';
            </script>";
        }
        $response = validateToken($token);
        // Verifica si la solicitud fue exitosa
        if($response["codigo"] !== null)
        {
            echo "	<script type='text/javascript'>
                        window.location='logout.php';
                    </script>";
            $tokenValido = false;
            die();
        }
        else
        {
            $tokenValido = true;
        }
    ?>

    <script src="static/assets/js/scriptlab.js"></script>



    <?php
    $apiURL = apiTokenURL;
    $id_session = $response['objeto']['idTurno'];
    $time_start = $response['objeto']['fechaInicial'];
    $time_end = $response['objeto']['fechaFinal'];
    $usuario = $response['objeto']['apellido'] . " " . $response['objeto']['nombre'];

    $timezone = date_default_timezone_get();
    $date =  date('d/m/Y', strtotime($time_start));

    // Crea un objeto DateTime especificando la zona horaria como UTC
    $datetimeStart = new DateTime($time_start, new DateTimeZone('UTC'));
    $datetimeEnd = new DateTime($time_end, new DateTimeZone('UTC'));
    $datetimeEnd->modify('+1 second');
    $interval = $datetimeStart->diff($datetimeEnd);
    $sessionMinutes = $interval->i;

    // Formatea la fecha y hora según tus necesidades
    $dateAndTimeEnd = $datetimeEnd->format('Y-m-d H:i:s');

    $timeInit = $datetimeStart->format('H:i');
    $timeEnd = $datetimeEnd->format('H:i');
    ?>

    <title>Lab remote</title>


</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
        <div class="container-fluid">


            <a class="navbar-brand" href="#"><i class="fa-solid fa-microchip"></i>&nbsp; Laboratorio remoto PSE </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars01" aria-controls="navbars01" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>

    <div class="container mt-5 text-center">


        <div class="row">
            <!-- PRIMERA FILA-->

            <div class="col-sm-6">
                <!-- PRIMERA COLUMNA-->
                <!-- col-6 -->


                <form action="" id="data" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <!-- <label for="formFile" class="form-label">Seleccione el archivo</label> -->
                        <input class="form-control" type="file" id="userfile" name="userfile" title="" />

                    </div>

                    <div class="mb-3">
                        <button id="comp" type="submit" value="Upload" class="btn btn-dark" name="comp">Compilar</button>
                    </div>

                    <div class="form-check form-switch text-start">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="checkUpdate">
                        <label class="form-check-label" for="flexSwitch">Subir</label>
                    </div>

                    <div class="mb-3" id="resulCpl">

                    </div>
                </form>

            </div>

            <div class="col-sm-6">
                <!-- SEGUNDA COLUMNA-->
                <!-- col-6 -->
               
                <div class="card" style="width: 23rem;">

                    <h5 class="card-header">Video en linea</h5>
    
                    <!-- <img src="http://laboremotounaj.ddns.net:8080/?action=stream" id = 'frame' />  -->
                    <img src="http://localhost:8080/?action=stream" id = 'frame' />  
                    <!-- <video id="medio" class="card-img-top"></video> -->


                    <!-- <div class="card-body"> -->
                    <!-- <h5 class="card-title">Resultados</h5> -->
                    <!-- <p class="card-text"></p> -->

                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <!-- SEGUNDA FILA-->

            <div id="rc" class="col-sm-6">
                <!-- PRIMERA COLUMNA -->
                <!-- col-6 -->
                <div class="card">
                    <h5 class="card-header">Resultados de la compilación</h5>

                    <div class="card-body" id="alertas">


                    </div>
                </div>
            </div>

            <div id="ms" class="col-sm-6">
                <!-- SEGUNDA COLUMNA -->

                <div class="card">


                    <h5 class="card-header">Monitor serie</h5>


                    <div class="card-body">


                        <label id=bds for="baud" class="">Seleccione Baudios</label>
                        <div class="mb-3"> </div>

                        <div class="mb-3">
                            <select class="form-select form-select-sm" id="baudios">
                                <option>300</option>
                                <option>600</option>
                                <option>1200</option>
                                <option>2400</option>
                                <option>4800</option>
                                <option selected="selected">9600</option>
                                <option>14400</option>
                                <option>19200</option>
                                <option>28800</option>
                                <option>38400</option>
                                <option>57600</option>
                                <option>115200</option>
                            </select>
                        </div>


                        <div class="mb-3">


                            <label id=sgs for="seg" class="">Seleccione segundos</label>
                            <div class="mb-3"> </div>
                            <select class="form-select form-select-sm" id="segundos">

                                <option selected="selected" value="5">5 seg</option>
                                <option value="10">10 seg</option>
                                <option value="20">20 seg</option>
                                <option value="40">40 seg</option>
                                <option value="60">60 seg</option>
                                <option value="120">120 seg</option>

                            </select>

                        </div>



                        <div class="mb-3">


                            <button id="str" type="submit" class="btn btn-dark">Iniciar</button>

                            <!-- <button id= "stp" type="submit" class="btn btn-danger">Parar</button> -->

                            <button id="lmp" type="submit" class="btn btn-primary">Limpiar</button>

                        </div>

                        <div class="mb-3 text-center " id="contentPs" style="overflow:auto; max-height:12em;">




                        </div>


                    </div>
                </div>


            </div>

        </div>

        <div class="row mt-3 justify-content-around">

            <div class="col-sm-4" id="ses">

                <div class="card text-center">


                    <h5 class="card-header">

                        Gestion de la Sesión

                    </h5>
                    <!-- <div class="card-header">
                          Featured
                 </div> -->

                    <div class="card-body" style="overflow:auto; min-height:18em;">

                        <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->



                        <div class="card text-center bg-light text-dark">
                            <p class="m-0 p-0"><b>Usuario <i class="fa-solid fa-user"></i></b></p>
                            <p class="m-0 p-0"><?php echo $usuario ?></p>

                        </div>

                        <div class="card text-center mt-2 bg-light text-dark">
                            <p class="m-0 p-0"><b>Reservación activa</b></p>
                            <p class="m-0 p-0"><i class="fa-regular fa-calendar-days"></i> <?php echo "$date"; ?></p>
                            <p class="m-0 p-0"><i class="fa-regular fa-clock"></i> <?php echo "$timeInit" . "-" . "$timeEnd"; ?></p>

                        </div>

                        <div class="card text-center mt-2 bg-light text-dark">
                            <p class="m-0 p-0"><b>Tiempo restante</b> <i class="fa-regular fa-bell"></i></p>
                            <p class="m-0 p-0">
                            <div class="wrapper-timer" id="wrapper-timer"></div>
                            <p>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progress"></div>
                            </div>

                        </div>


                        <button class="btn btn-secondary mt-2" value='<?php echo $id_session; ?>'> <i class="fa-solid fa-power-off"></i>Eliminar Sesión</button>


                    </div>





                </div>

            </div>

            <div class="col-sm-4" id="tec">


                <div class="card text-center" style="max-height:22em; max-width: 15em;">


                    <h5 class="card-header">

                        Teclado matricial

                    </h5>

                    <div class="card-body bg-dark">


                        <table class="table table-borderless" id="teclado">

                            <tbody>
                                <tr>
                                    <td><button class="btn btn-primary border border-white btn-c" value="1" id="an">1</button></td>
                                    <td><button class="btn btn-primary border border-white btn-c" value="2">2</button></td>
                                    <td><button class="btn btn-primary border border-white btn-c" value="3">3</button></td>
                                    <td><button class="btn btn-danger border border-white btn-c" value="A">A</button></td>
                                </tr>
                                <tr>

                                    <td> <button class="btn btn-primary border border-white btn-c" value="4">4</button></td>
                                    <td><button class="btn btn-primary border border-white btn-c" value="5">5</button></td>
                                    <td><button class="btn btn-primary border border-white btn-c" value="6">6</button></td>
                                    <td><button class="btn btn-danger border border-white btn-c" value="B">B</button></td>
                                </tr>
                                <td> <button class="btn btn-primary border border-white btn-c" value="7">7</button></td>
                                <td><button class="btn btn-primary border border-white btn-c" value="8">8</button></td>
                                <td><button class="btn btn-primary border border-white btn-c" value="9">9</button></td>
                                <td><button class="btn btn-danger border border-white btn-c" value="C">C</button></td>
                                </tr>

                                <td> <button class="btn btn-danger border border-white btn-c" value="*">*</button></td>
                                <td><button class="btn btn-primary border border-white btn-c" value="0">0</button></td>
                                <td><button class="btn btn-danger border border-white btn-c" value="#">#</button></td>
                                <td><button class="btn btn-danger border border-white btn-c" value="D">D</button></td>
                                </tr>
                            </tbody>

                        </table>






                    </div>


                </div>


            </div>





        </div>



        <div class="row mt-3">

            <div class="col-sm-4 offset-sm-4">

            </div>

        </div>

    </div>

    <footer class="text-center mt-auto bg-dark">

        <!-- Copyright -->
        <div class="text-center text-light p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 Copyright: 
        </div>
        <!-- Copyright -->
    </footer>

</body>


<script>
    
    //Establecer la fecha en la que estamos contando hacia atrás. En este caso solo es la hora final de la reserva. 
    var countDownDate = new Date("<?php echo $dateAndTimeEnd ?>").getTime();
    var sessionTime = <?php echo $sessionMinutes ?> * 60;

    // Actualizar la cuenta regresiva cada 1 segundo
    var x = setInterval(function() {

         // Obtener la fecha y hora de hoy
        var now = new Date().getTime();

        //var test = new Date().getHours();
        // Encuentra la distancia entre ahora y la fecha de la cuenta regresiva
        var distance = countDownDate - now;

        // Cálculos de tiempo para días, horas, minutos y segundos.
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);


        // Muestra el resultado en un elemento con id="demo"
        document.getElementById("wrapper-timer").innerHTML = minutes + "m " + seconds + "s ";



        // Si la cuenta regresiva ha terminado, volvemos a la gestión de reservas. Se termino la sesión
        if (distance < 0) {
            clearInterval(x);
            window.location.replace('/logout.php');
    
        }

        var currentPercent = Math.round(((minutes*60) * 100) / sessionTime);

        $("#progress").css("width", (currentPercent+"%"));
        if (currentPercent < 10) {
            $('#progress').removeClass().addClass('progress-bar bg-danger');
        }
        else if (currentPercent < 25) {
            $('#progress').removeClass().addClass('progress-bar bg-warning');
        }
        else
        {
            $('#progress').removeClass().addClass('progress-bar bg-success');
        }
    }, 1000);

    $(document).on("click", ".btn-secondary", function() {
    var val = $(this).val();

    // URL de la API y ID a eliminar
    var apiURL = "<?php echo $apiURL ?>/turno"; // Reemplaza con la URL de tu API
    var idToDelete = val;
    $.ajax({
        type: "DELETE", // Cambiado a método DELETE
        url: apiURL + "/" + idToDelete, // URL de la API junto con el ID a eliminar
        success: function(response) {
            if (response == 1) {
                window.location.replace('/logout.php');
            }
            else
            {
                alert(response.responseJSON.mensaje);
            }
        },
        error: function(response){
            alert(response.responseJSON.mensaje);
        }
    });
});
</script>

</html>