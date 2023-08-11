
function formEsValido()
{
    var nombre = $("#nombre_votacion");
    var descripcionVotacion = $("#descripcion_votacion");
    var votantes = $("#votantes");

    if( nombre.val() == "")
    {
        var op = alertify.alert("Debe colocar un nombre de votación." );
        return false;
    }
    else if( descripcionVotacion.val() == "")
    {
        var op = alertify.alert("Debe colocar una descripcion." );
        return false;
    }
    else if( !$('input[type=radio]:checked').size() > 0)
    {
        var op = alertify.alert("Debe elegir una categoria." );
        return false;
    }
    else if( asistentes.val() == "")
    {
        var op = alertify.alert("Debe colocar una cantidad de votantes." );
        return false;
    }
 
    return true;
}

function register_vote()
{ 
    $("#submit_button")
    {
        if(formEsValido())
        {
            cadena = $("#vote_form").serialize();
            alert(cadena);

            $.ajax(
            {
                type: 'POST',
                url: "../../Controller/vote_register.php",
                data: cadena,
                success: function(data) 
                {
                    if(data==0)
                    {
                        message = alertify.success("El registro se realizó exitosamente");
			window.location = "admin_view.php";
                    }
                    else 
		    {
			alertify.error("No se pudo registrar la votacion.");
                        window.location = "vote_register_page.php";
		    }
                }
                
            })
        }
    }
}
