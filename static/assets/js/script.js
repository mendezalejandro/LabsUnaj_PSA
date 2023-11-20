$(document).ready(function() {

    
    $("#error2").show();

    $('#pass2').keyup(function() {

    

        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();

        if (pass1 == pass2) {
            $("#error2").show();
            $('#error2').css("background", "url(static/assets/img/check.png)");
            $( "#reg" ).prop( "disabled", false);
           
        } else {
            $("#error2").show();
            $('#error2').css("background", "url(static/assets/img/check-.png)");
            $( "#reg" ).prop( "disabled", true);

            
        }
        debugger;

        if(pass2 == ""){
        
            $("#error2").hide();
            $( "#reg" ).prop( "disabled", false);
        }
        

    });

});