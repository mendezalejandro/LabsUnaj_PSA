$(document).ready(function () {


    $('#teclado').on('click', '.btn-c', function() {
       
        var key = $(this).val();
        $.ajax({
            url: 'static/function/dataSend.php',
            type: 'POST',

            data: {
                key: key
            },
            dataType: "html",
            success: function(response) {

                alert(response);

            }
        });
    
    });




    $('#userfile').on('change', function() {

        $("#alertas").empty();
        $("#resulCpl").empty();


    });

   
    $("form#data").submit(function(e) {
       
        e.preventDefault();
        $("#resulCpl").empty();
        $("#alertas").empty();


         $( "#comp" ).prop( "disabled", true);
        
          $( "#str" ).prop( "disabled", true );
          $( "#lmp" ).prop( "disabled", true );
          $( "#segundos").prop( "disabled", true);
          $( "#baudios").prop( "disabled", true);

        let check = $('#flexSwitchCheckDefault').val();
        var formData = new FormData(this);
        formData.append('fileid', check);
        
       
        $.ajax({
            url: 'static/function/compile.php', //RUTA A LA QUE SE DIRIGE
            type: 'POST',
            enctype: 'multipart/form-data',
            data: formData, //MANDA LOS DATOS DEL FORMULARIO. 
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {

                let tasks = response;
                let template = '';

                const errores = [
                    "There is no error, the file uploaded with sucess",
                    "The uploaded file exceeds the upload_max filesize directive in php.ini",
                    "The uplodad file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                    "The uploaded file was only partially uploaded",
                    "Archivo no seleccionado",
                    "",
                    "Missing a temporaly folder",
                    "Failed to write file to disk",
                     "A PHP extension stopped the file upload.",
                     "Invalida extensión. (Validas: .ino, cpp)",
           
                  ];

                  const resulCompilacion = [
                    "El archivo ha sido compilado con exito",
                    "Hubo un error en la compilacion",
                    "El archivo ha sido compilado y subido con exito",
                  ];

                if(tasks  == 'e' || tasks  == 'c' || tasks == 'error'){

                    if(tasks == 'e'){

                        // <div class="alert alert-sucess"></div> 
                        template += `
                        <div class="alert alert-success">${resulCompilacion[2]}</div> 
                        ` 
                        $('#alertas').html(template);

                    }
                    if(tasks == 'c'){

                        template += `
                        <div class="alert alert-success">${resulCompilacion[0]}</div>
                        ` 
                        $('#alertas').html(template);
                    }

                    if(tasks == 'error'){

                        template += `
                        <div class="alert alert-danger">${resulCompilacion[1]}</div>
                        ` 
                       $('#alertas').html(template);

                    }

                }else{
                    
                        template += `
                        <div class="alert alert-danger">${errores[tasks]}</div>
                        ` 
                       $('#resulCpl').html(template);

                }

                $("#userfile").val("");
                
                $( "#comp" ).prop( "disabled", false);
        
                $( "#str" ).prop( "disabled", false );
                $( "#lmp" ).prop( "disabled", false );
                $( "#segundos").prop( "disabled", false);
                $( "#baudios").prop( "disabled", false);
                
            }

        });
    });




    // $("#stp").hide();
    // $("#submit-form").on("submit", function(e){

    // e.preventDefault();

    // var formData = new FormData(this);
    

  
    
    // $.ajax({

    //     url: "compile.php",
    //     type: "POST",
    //     data: formData,

    //     //data:  {formData: formData, sw: sw}, 
    //     //  cache: false,
    //     //  contentType: false,
    //     //  processData: false,
      

    //   success: function (response) {

    //     if(!response.error) {
      
    //         //$('#respuesta').html(response);

    //     }

    // }

    // })
    
    
    // });




    

    $("#lmp").click(function(){
        $("#contentPs").empty();
    });

    var ms = document.getElementById("ms");
    var rc = document.getElementById("rc");

    var ses =  document.getElementById("ses");
    var tec =  document.getElementById("tec");

    let query = window.matchMedia('(min-width: 576px)');

    if (query.matches) {

        ms.className = "col-sm-6 mb-5";
        rc.className = "col-sm-6 mb-5";
        ses.className = "col-sm-4 mb-5";
        tec.className = "col-sm-4";
        // console.log("Hola");
    } else {

        ms.className = "col-sm-6";
        rc.className = "col-sm-6";
        ses.className = "col-sm-4";
        tec.className = "col-sm-4 mt-5";
    }


    $("#str").on("click",function(event){
        event.preventDefault();
        if($('#baudios').val() && $('#segundos').val() ) {
            let baud = $('#baudios').val();
            debugger;
            let seg = $('#segundos').val();
            //let lim = $('#lim').val();            
           // $(#stp").removeAttr("style")

            // let inf = $('#inf').val();
            $( "#str" ).prop( "disabled", true );
            $( "#lmp" ).prop( "disabled", true );
            $( "#comp" ).prop( "disabled", true);
            $( "#userfile").prop( "disabled", true);
            $( "#flexSwitchCheckDefault").prop( "disabled", true);
            $( "#segundos").prop( "disabled", true);
            $( "#baudios").prop( "disabled", true);
           
            
            $.ajax({
                url: 'static/function/data.php',
                data: {baud: baud,  seg: seg},
                type: 'POST',
                success: function (response) {

                if(!response.error) {

                    let tasks = response;
                    let template = '';
                    debugger;
                    template += `
                            <p>${tasks}</a></p>
                            ` 
                    $('#contentPs').html(template);
                    $( "#str" ).prop( "disabled", false);
                    $( "#lmp" ).prop( "disabled", false);
                    $( "#comp" ).prop( "disabled", false);
                    $( "#userfile").prop( "disabled", false);
                    $( "#flexSwitchCheckDefault").prop( "disabled", false);
                    $( "#segundos").prop( "disabled", false);
                    $( "#baudios").prop( "disabled", false);
                    
                }
                } 
            })

        }
        
    });
});








// function sendRequest(){

//     var theObject = new XMLHttpRequest();
//     theObject.open('POST', 'data.php', true)
//     theObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     theObject.onreadystatechange = function () {
//         document.getElementById('title').innerHTML = theObject.responseText;
//     }

// }





// document.addEventListener('DOMContentLoaded', init);

// function init() {

//     var ms = document.getElementById("ms");
//     var rc = document.getElementById("rc");

//     let query = window.matchMedia('(min-width: 576px)');

//     if (query.matches) {

//         ms.className = "col-sm-6 mb-5";
//         rc.className = "col-sm-6 mb-5";
//         console.log("Hola");
//     } else {

//         ms.className = "col-sm-6";
//         rc.className = "col-sm-6"; 
//     }
// }

