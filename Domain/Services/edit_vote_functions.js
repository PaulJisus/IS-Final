
function formEsValido()
{
    var nombre = $("#nombre_votacion");
    var descripcionVotacion = $("#descripcion_votacion");
    var votantes = $("#votantes");

    if( nombre.val() == "")
    {
        var op = alertify.alert("Debe colocar un nombre de votacion." );
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
    else if( votantes.val() == "")
    {
        var op = alertify.alert("Debe colocar una cantidad de votantes." );
        return false;
    }
 
    return true;
}

function editt_votacion()
{
    $("#submit_buttonn")
    {
        if(formEsValido())
        {
            cadena = $("#votacion_formm").serialize();
            alert(cadena);
            
            $.ajax(
            {
                type: 'POST',
                url: "../../Controller/vote_edit.php",
                data: cadena,
                success: function(data) 
                {
                    if(data==0)
                    {
                        message = alertify.success("La votación se editó exitosamente");
                    }
                    else 
                    {
                        alertify.error("No se pudo editar la votación.");
                        window.location = "admin_view.php";
                    }
                }
                    
            })
        }
    }
}
