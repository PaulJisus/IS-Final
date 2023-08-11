<html>
<head>
<title> Únete a CSC </title>
<link rel="stylesheet" href="CSS_Files/register.css">
<?php   include_once("../Services/include_important.php");  ?>
</head>

<body background="Images/blue_background.jpg"  style="background-size: cover"> 

<br><br>
    <div class="jumbotron" id="signup_container" style="background:#cfe5ff">  <!-- c2f5c3 -->
        <div align="center" >
            <img src="Images/register_icon.png" alt="Icono de registrarse" width="150" height="150"> 
            <h1 class="display-5"> Registrar Candidato </h1>
        </div>
        <br>

    <form id="signup_form" >
        <label for="name"> Nombres: </label>
        <input type="text" name="name" id="name" class="form-control">
        <label for="last_name"> Apellidos: </label>
        <input type="text" name="last_name" id="last_name" class="form-control">
        <label for="e_mail"> Correo Electrónico: </label>
        <input type="email" name="e_mail" id="e_mail" class="form-control">
        <label for="telefono"> Número de telefono: </label>
        <input type="tel" name="telefono" id="telefono" class="form-control">
        <label for="nationality"> Nacionalidad: </label>
        <input type="text" name="nationality" id="nationality" class="form-control">
        
            <br> 
        
        <div align="right">
            <button type="button" id="submit_button" class="btn btn-success" > Registrarse </button>
        </div>
    
    </form>
    <br>  ¿Ya tienes una cuenta? 
        <a href="vote_view.php"> Volver </a>
    </div>
</body>
</html>



<script>
    function formEsValido()
    {
        var nombres = $("#name");
        var apellidos = $("#last_name");
        var correo_electronico = $("#e_mail");
        var telefono = $("#telefono");
        var nacionalidad = $("nationality");

        if( nombres.val() == "")
        {
            var op = alertify.alert("Debe ingresar sus nombres." );
            return false;
        }
        else if( apellidos.val() == "")
        {
            var op = alertify.alert("Debe ingresar sus apellidos." );
            return false;
        }
        else if( correo_electronico.val() == "")
        {
            var op = alertify.alert("Debe ingresar su correo electrónico." );
            return false;
        }
        else if( telefono .val() == "")
        {
            var op = alertify.alert("Debe ingresar su numero de telefono." );
            return false;
        }
        else if(nationality.val() == "")
        {
            var op = alertify.alert("Debe ingresar su nacionalidad." );
            return false;
        }
        return true;
    }

    $(document).ready( function() 
    { 
        $("#submit_button").click( function() 
        {
            if(formEsValido())
            {
                cadena = $("#signup_form").serialize();

                $.ajax(
                {
                    type: 'POST',
                    url: "../../Controller/register_candidate.php",
                    data: cadena,
                    success: function(data) 
                    {
                        if(data==0)
                        {
                            /*alertify.set('notifier','position', 'top-center');*/
                            message = alertify.success("El registro se realizó exitosamente");
                            
                            window.setTimeout(function()
                            {
                                message = alertify.success("Redirigiendo a la página principal ...");
                            } , 3000);

                            window.setTimeout(function()
                            {
                                window.location="main_view.php";
                            } , 6000);
                            
                        }
                        else 
						{
							alertify.error("No se pudo registrar el candidato.")
						}
                    }
                    
                })
            }
            
        })
    })
</script>
