 # INGENIERÍA DE SOFTWARE I -- PROYECTO FINAL 

## Propósito del proyecto

El presente trabajo se basa en la creación de un sistema de elección online, que permita llevar a cabo elecciones exitosas a pequeña escala en organizaciones. El objetivo principal es desarrollar un sistema que facilite el proceso de votación, permitiendo a los electores registrados emitir su voto de manera segura y eficiente.

## Funcionalidades: Diagrama de Casos de Uso y Prototipo (o GUI). 

![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/1.png)

![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/pasted%20image%200%20(1).png)

![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/pasted%20image%200.png)

![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/pasted%20image%200%20(2).png)


## Modelo de Dominio: Diagrama de Clases y Módulos.

![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/3.png)

![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/6.png)

## Arquitectura y Patrones: Diagrama de Componentes o Paquetes.

![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/2.png)

![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/5.png)

## Funcionalidades 
- [ ] Registrar Usuario: Esta es una funcionalidad mediante la cual un usuario puede ser registrado en el sistema de forma fácil y rápida
- [ ] Buscar votacion: Se pueden buscar votaciones mediante sus categorias.
- [ ] Mostrar estadísticas de la votacion: Se deben mostrar ciertas estadísticas de la votacion.
- [ ] Mostrar detalles de la votacion: Se debe mostrar detalles como el tipo de votacion y alguna descripcion.
- [ ] Agregar Votacion: El administrador puede agregar votaciones al sistema, los cuales se publicarán automáticamente, para que puedan ser vistos y buscados por los usuarios del sistema
- [ ] Actualización de Votaciones: Se puede actualizar una votacion si hubo algun cambio.


## Prácticas de codificación limpia aplicadas: Descripción y Fragmento de Código

- [ ] _1 - Comentar y Documentar_
	Se ha documentado el codigo en el RedMe del repositorio. Ademas, se ha comentado las funciones y clases con las que podrían haber confusiones 
	```
	// Se hacen las consultas para autenticar el inicio de sesion
	$query1 = "SELECT id FROM Usuario WHERE nombre_de_usuario='$username' AND clave='$password'";
	$query2 = "SELECT id FROM Organizador WHERE nombre_de_usuario='$username' AND clave='$password'";
	
	$result1=mysqli_query($conn, $query1);
	$result2=mysqli_query($conn, $query2);

	// Se verifica si la cuenta esta en la base de datos
	if(mysqli_num_rows($result1) > 0)
	{
        	echo 0;
        	while ($registro = mysqli_fetch_array($result1))
        	{
            		$id = $registro["id"];
            		$_SESSION["id"] = "$id";
        	}
        	$_SESSION["permisos"] = "admin";
	}
	else if (mysqli_num_rows($result2) > 0)
	{
		echo 1;
        	while ($registro = mysqli_fetch_array($result2))
        	{
            		$id = $registro["id"];
            		$_SESSION["id"] = "$id";
        	}
        	$_SESSION["permisos"] = "user";
    	}
	```

- [ ] _2 - Sangrado consistente_
	Se ha aplicado sangría a todas los archivos.
	Ejemplo del código:
```
<?php

class Votacion
{

    public  $idVotacion;
    public  $nombre;
    public  $descripcion;
    public  $pais;

    public function __construct($result_array)
    {
        $this->idVotacion = $result_array["id"];
        $this->nombre = $result_array["nombre"];
        $this->descripcion = $result_array["descripcion"];
        $this->pais = $result_array["pais"];
    }
```
	
	
- [ ] _3 - Evite Comentarios Obvios_

	Se han usado comentarios precisos, que no llegan a ser redundantes.
	
- [ ] _4 - Agrupación de Código_

Se agrupan los bloques de código que cumplen una propósito en conjunto:
```
	session_start();
	require_once("../Repositories/Classes/Conexion.php");
	$connection = new Conexion;
	$conn = $connection->OpenConnection();

	$username = $_POST["user_name"];
	$password = $_POST["password"];
	$_SESSION["username"] = "$username";
    
	$query1 = "SELECT id FROM Usuario WHERE nombre_de_usuario='$username' AND clave='$password'";
	$query2 = "SELECT id FROM Organizador WHERE nombre_de_usuario='$username' AND clave='$password'";
	$result1=mysqli_query($conn, $query1);
	$result2=mysqli_query($conn, $query2);

```

- [ ] _5 - Esquema de Nomenclatura Consistente_
```
En PHP se tienen esquemas de nomenclatura consistentes relativamente flexibles:

strpos() vs. str_split()
imagetypes() vs. image_type_to_extension()
En primer lugar, los nombres deberían tener límites en sus palabras. Hay dos opciones populares:

camelCase: La primera letra de cada palabra está en mayúscula, excepto la primera palabra.
Guiones bajos: Guiones bajos entre palabras, tales como: mysql_real_escape_string ().
```

- [ ] _6 - Principio DRY_

	(Don't repeat yourself)
	No se produce la repetición de codigo en ninguna pare del proyecto.
	Por ejemplo en la Base de Datos, no es repetida ninguna pieza de información, cada tabla contiene información única sin duplicados :
```
CREATE TABLE Organizador (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(25),
    apellidos VARCHAR(30),
    correo_electronico VARCHAR(30),
    nombre_de_usuario VARCHAR(20), 
    clave VARCHAR(30),
    telefono VARCHAR(9)
);
    
CREATE TABLE Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(25),
    apellidos VARCHAR(30),
    correo_electronico VARCHAR(30),
    nombre_de_usuario VARCHAR(20), 
    clave VARCHAR(30),
    telefono VARCHAR(9),
    cantidad_votacion INT
);
   
CREATE TABLE Candidato (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(25),
    apellidos VARCHAR(30),
    correo_electronico VARCHAR(30),
    telefono VARCHAR(9),
    nacionalidad VARCHAR(20)
);
```

- [ ] _7 - Evite la Anidación Profunda_

	Las anidaciones profundas son evitadas lo más que sea posible.
	Ejemplo en el Código (Condicional Simple): 
	
```
	$conn = $connection->OpenConnection();
        $query = "SELECT nombre, id, descripcion, pais
                  FROM Evento";
        $query2 = "SELECT id, nombres, apellidos, correo_electronico, telefono FROM";
        
        if ($_SESSION["permisos"] == "admin")
        {
            $query2 = $query2 . " Organizador";
        }
        else
        {
            $query2 = $query2 . " Usuario";
        }
```

- [ ] _8 - Organización de Archivos y Carpetas_

	La organización de las carpeta se realizó del siguiente modo:
	
![image](https://github.com/PaulJisus/IS-Final/blob/main/Assets/carpetas.png)

- [ ] _9 - Capitalizar Palabras Especiales de SQL_
```
	$query = "INSERT INTO  usuario (nombres, apellidos, correo_electronico, nombre_de_usuario, clave, telefono) VALUES ('$name', '$last_name', '$e_mail', '$username', '$password', '$cellphone');";
	$result = mysqli_query($conn, $query);
    
	$last_id_query = "SELECT MAX(id) FROM Usuario;";
	$result = mysqli_query($conn, $last_id_query);
```


## Estilos de Programación aplicados: Descripción y Fragmento de Código


→ Lazy Rivers: Este es un estilo de programación en el que el flujo de datos en una función en particular viene en "arroyos" y no agrupa todo de frente. 
En el caso de la función register_vote() es en donde se usa este estilo de programación, no está todo dentro de esta función, si no que acá se usa otro "arroyo" (función), esta función es la de formEsValido(), a su vez esta función mediante ajax llama a vote_register, que no es una función, sin embargo actua como una, lo que hace es procesar los datos y añadirlos en la base de datos si estos son correctos. De esta forma el código es más entendible y no está todo agrupado en una sola función.
También se usa este estilo para otra vista, la de editar votacion.

```
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

```


→ Restful: Este es un estilo de programación muy usado en páginas web en donde se separa la interfaz del usuario con la parte del procesamiento de datos en el servidor, se puede usó este estilo para trabajar de forma más cómoda
```
Todas las vistas están separadas de los servicios, por eso hay 2 subscarpetas
Services
Views

Y las funcionalidades del servidor están en
../Controller

```

→ Cookbook: Es un estilo de programacion sin entradas ni salidas, orientados a procedimientos en forma de una secuencia para resolver un problema. Al terminar de manera correcta un registro, el redireccionamiento no necesita de entradas ni salidas, por lo que es una simple secuencia de procedimientos para notificar al usuario y redireccionarlo a una pagina de inicio de sesion.

Funciones en estilo cookbock.

```
/// 
/// Funcion dnetor del cookbook para mostrar un mensaje de redireccionamiento
///
function RedirectMessage()
{
    alertify.success("El registro se realizó exitosamente");
}

/// 
/// Funcion para redireccionar a una pagina(login). 
///

function setLocation($window,$new_location)
{
    window.location=$new_location;
}

function Redirect()
{
    setTimeout(setLocation, 2000,window,"main_view.php");

}
```
Uso dentro de un ajax
```
$.ajax(
{
    type: 'POST',
    url: "../../Controller/register.php",
    data: cadena,

    success: function(data) 
    {

        if(data==0)
        {
            ///
            /// Uso del Cookbook para el redireccionamiento
            ///
            RedirectMessage()
            Redirect()
        }
        else 
        {
            alertify.error("No se pudo registrar sus usuario.")
        }
    }

})
```


→ Kick forward: Variación del estilo de la fábrica de dulces, con las siguientes limitaciones adicionales:(main_view.php)_

* _Cada función toma un parámetro adicional, generalmente el último, que es otra función_
* _Ese parámetro de función se aplica al final de la función actual_
* _Ese parámetro de función se da como entrada cuál sería la salida de la función actual_
* _El problema más grande se resuelve como una tubería de funciones, pero donde la siguiente función que se aplicará se da como parámetro a la función actual_
* _Esto nos permite optimizar el codigo evitando funciones innecesarias y ademas de la escalabilidad a la hora de usar muchas funciones en el codigo_
* _Este estilo nos permite optimizar el codigo evitando funciones innecesarias y ademas de la escalabilidad a la hora de usar muchas funciones en el codigo_

```
function show_vote(id_votacion)
{
    window.location="vote_view.php?id=" + id_votacion ;
}
```

## Principios SOLID aplicados: Descripción y Fragmento de Código
- [ ] _S – Single Responsibility Principle (SRP)_
  “Una clase debe tener una sola razón para cambiar”, es decir, debe tener una sola responsabilidad.
  Este principio se ocupa específicamente de la cohesión.  La cohesión se define como la afinidad funcional de los elementos de un módulo.
  
  Ejemplo de uso:
  Los "models" tienen un único propósito, éste es representar el conocimiento que el equipo tiene sobre el dominio, expresado en clases:
```
<?php

class Votacion
{

    public  $idVotacion;
    public  $nombre;
    public  $descripcion;
    public  $pais;

    public function __construct($result_array)
    {
        $this->idVotacion = $result_array["id"];
        $this->nombre = $result_array["nombre"];
        $this->descripcion = $result_array["descripcion"];
        $this->pais = $result_array["pais"];
    }

    public function get_values()
    {
        $values = [
            "id" => "$this->idVotacion",
            "nombre" => "$this->nombre",
            "descripcion" => "$this->descripcion",
            "pais" => "$this->pais",
        ];
        return $values;
    }

}
```
 En este caso, la clase Votacion representa la información que se debe conocer sobre cada instacia votacion del proyecto. No tiene ninguna función innecesaria ni irrelevante en ninguna de las clases del proyecto.


- [ ] _O – Open/Closed Principle (OCP)_
  "Las entidades de software (clases, módulos, funciones, etc.) deben estar abiertas para una extensión, pero cerradas para modificaciones". 
  Podemos extender el comportamiento de una clase, cuando sea necesario, a través de la herencia, la interfaz y la composición. 
  Sin embargo, no podemos permitir que la apertura de esta clase haga modificaciones menores.
  
  Ejemplo de uso:
  
  El concepto de DDD: Repositorio sigue el patrón de diseño Strategy, por lo cual, obedece también el principio OCP:
```
interface iConexion
{
  public function __construct();
  public function OpenConnection();
  public function CloseConnection();
}


class Conexion implements iConexion
{
  public $dbhost;
  public $dbuser;
  public $dbpassword;
  public $dbname;
  public $conexion;
  
  public function __construct()
  {
    $this->dbhost = "localhost";
    $this->dbuser = "root";
    $this->dbpassword = "root";
    $this->dbname = "mainDB";
    $this->conexion = null;
  }

  public function OpenConnection()
  {
    $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
    return $this->connection;
  }
 
  function CloseConnection()
  {
    $this->conexion = null;
  }
}
```
La clase Conexion implementa la interfaz iConexion, lo que le permite definir una familia de comportamientos similares (en este caso se podrían crear clases que implementen la interfaz iConexion para obtener conexiones para SGBD distintas a MySQL y que sobreescriban los métodos de conexión para cada caso), poner cada uno de ellos en una clase separada y hacer que sus objetos sean intercambiables (poder usar cualquier conexión indistintamente de a que SGBD se intenten conectar), por lo que está abierta para extensiones (de otras SGBD) y cerrada para modificaciones (tienen los mismos métodos en todas la implementaciones).



- [ ] _L – Liskov Substitution Principle (LSP)_
"Cada clase que hereda de otra puede usarse como su padre sin necesidad de conocer las diferencias entre ellas."

Principio de sustitución de Liskov o LSP (Liskov Substitution Principle) es un principio de la programación orientada a objetos. y puede definirse como: Cada clase que hereda de otra puede usarse como su padre sin necesidad de conocer las diferencias entre ellas.

En lenguaje más formal: si S es un subtipo de T, entonces los objetos de tipo T en un programa de computadora pueden ser sustituidos por objetos de tipo S (es decir, los objetos de tipo S pueden sustituir objetos de tipo T), sin alterar ninguna de las propiedades deseables de ese programa (la corrección, la tarea que realiza, etc.)

En Statistics.php clase usada para implementar la impresion de las estadisticas de cada votacion podemos presenciar el uso de la implementacion de las clases superiores sin necesidad de alterar las propiedades principales del programa

```
<?php

interface IStatictics
{
    public function __construct($result_array);
    public function get_values();
}

class Statictics implements IStatictics
{
    public  $organizador_apellidos;
    public  $session_id;
    public  $session_date;
    public  $usuario_apellidos;

    public function __construct($result_array)
    {
        $this->organizador_apellidos = $result_array["organizador_apellidos"];
        $this->sesion_id = $result_array["sesion_id"];
        $this->sesion_fecha = $result_array["sesion_fecha"];
        $this->usuario_apellidos = $result_array["usuario_apellidos"];
    }

    public function get_values()
    {
        $values = [
            "organizador_apellidos" => "$this->organizador_apellidos",
            "sesion_id" => "$this->sesion_id",
            "sesion_fecha" => "$this->sesion_fecha",
            "usuario_apellidos" => "$this->usuario_apellidos"
        ];
        return $values;
    }
    
}

```

- [ ] _I – Interface Segregation Principle (ISP)_
"Muchas interfaces específicas son mejores que una única más general."
Consiste en encapsular las funciones de las clases que requieren hacer consultas en la base de datos sobre información que será mostrada al usuario. Esto se realiza mediante getters en cada clases.


```
<?php

interface funcionalidad_get
{
    public function get_values();
    
}

class Sesion implements funcionalidad_get
{
    public  $id;
    public  $hora;
    public  $fecha;
    public  $InformacionExtra;
    public  $Votacion;


    public function __construct($result_array)
    {
        $this->id = $result_array["id"];
        $this->fecha = $result_array["fecha"];
        $this->hora = $result_array["hora"];
        $this->Votacion = $result_array["informacionExtra"];
    }

    public function get_values()
    {
        $values = [
            "id" => "$this->id",
            "fecha" => "$this->fecha",
            "hora" => "$this->hora",
            "informacionExtra" => "$this->Votacion",
        ];
        return $values;
    }
```

Interface Segregation Principle, al usar varias clases que requieran obtener los datos para hacer las consultas de la BD, hacemos uso de una interfaz comun para las demas clases que tambien necesiten de hacer consultas.


- [ ] _D – Dependency Inversion Principle (DIP)_
"El problema cuando construimos software es que solemos hacer muchas dependencias y esto conlleva a un futuro que cambiar una pieza de nuestro código obliga a refactorizar todo el proyecto y esto no debería ser así."
Este principio trata acerca de que los módulos de alto nivel no deben depender de los módulos de bajo nivel, ambos deberían depender de interfaces, es decir, se basa en la abstracción.

```
Candidato.php
Organizador.php
Persona.php
Sesion.php
Statistics.php
Usuario.php
Votacion.php
```
Ninguno de los modulos dependen entre si.
---


## Conceptos DDD aplicados: Descripción y Fragmento de Código 

* SERVICIOS:
  - Servicio de Dominio: 
    Es donde se implementó toda la lógica del negocio (cumpliendo los requisitos).
  - Servicio de Aplicación:
    Es usada en casi cualquier funcionalidad implementada en los archivos
  - Servicio de Infraestructura:
    Son las funciones que no dependen del negocio (dominio).
    
  Se han creado servicios tanto en PHP como en JavaScript, las cuales cumplen con ejecutar uno de los servicios en especial para dar funcionamiento al proyecto.
```
function logout()
{
    $.ajax({
        url:'main_view.php?logout=true',
        type:'GET',
        success: function() 
        {
            alertify.confirm('¿Desea cerrar su sesión?',
            function()
            {
                alertify.set('notifier','position', 'top-center');
                alertify.message("Hasta luego.", 3);
                window.setTimeout(function()
                {
                    window.location="login_page.php";    
                } , 1500); 
            },
            function()
            {
                alertify.set('notifier','position', 'top-center');
                alertify.message("Siga con nosotros.", 4);
            }
            ).setHeader("Atención");
    	}
    })

}
```  
   
* ENTIDADES:
  Se han creado clases que representan entidades en el proyecto, tales como Clases Usario, Organizador, cuyas instancias tienen una identidad PROPIA para que puedan ser identificados, sus valores si pueden cambiarse a diferencia de los Value Object.
  
```
<?php

class Persona
{
    public  $id;
    public  $nombres;
    public  $apellidos;
    public  $correoElectronico;
    public  $telefono;
    public  $permisos;
    

    public function __construct($result_array, $permiso)
    {
        $this->id = $result_array["id"];
        $this->nombres = $result_array["nombres"];
        $this->apellidos = $result_array["apellidos"];
        $this->correoElectronico = $result_array["correo_electronico"];
        $this->telefono = $result_array["telefono"];
        $this->permisos = $permiso;
    }

}
```
* VALUE OBJECT:
  Similares a la entidades, pero carecen de identidad y son muy requeridos por sus atributos
  Usos en el proyecto:
  - Clases creadas para almacenar exclusivamente los valores que son inmutables (carecen de metodos para modificarlos), sus valores son inicializados en su construcción
  - Las imágenes incluidas  
  
* REPOSITORIES: 
  La logica del programa permite acceder a la capa de datos desde un elemento externo (ceonexion a MySQL desde PHP)  de modo que los modelos y los datos no estan acoplados

```
<?php

/*include("../Interfaces/iConexion.php");*/

class Conexion /*implements iConexion*/
{
  public $dbhost;
  public $dbuser;
  public $dbpassword;
  public $dbname;
  public $conexion;
  
  public function __construct()
  {
    $this->dbhost = "localhost";
    $this->dbuser = "root";
    $this->dbpassword = "root";
    $this->dbname = "mainDB";
    $this->conexion = null;
  }

  public function OpenConnection()
  {
    $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
    return $this->connection;
  }
 
  function CloseConnection()
  {
    $this->conexion = null;
  }

}

?>
```
  
* AGREGADOS: 
  Son elementos abstractos que engloban un Concepto general
  Usos en el proyecto:
  - Una Votacion en general incluye varias elementos como las clases:  Sesion, Candidatos, Ususario, etc; los engloba en un mismo concepto: Votacion los cuales pueden ser construidos por un Factory

* EVENTOS DE DOMINIOS: (Falta Implementar)
  Indica que lo eventos referentes a los elementos del programa deben ser almacenados 

* FACTORIAS: 
  Son Clases que pueden crear objetos para que luego sean usados como bloques.
  
  Al momento de crear Votaciones se hace uso del patron de diseño Factory para poder crear un elemento nuevo (Votacion)  a partir de los datos relacionados a éste.

* ARQUITECTURA EN CAPAS: 
  Se distinguen al menos 4 capas:
  - Vista: Implementadas en los archivos HTML y CSS (junto con Bootstrap) que representa la vista de cada funcionalidad del proyecto
  - Modelo: son las funciones vinculadas con el CRUD del proyecto a nivel interno.
  - Controlador: Implementadas exclusivamente  en los archivos PHP. Establece la conexión entre Vista y Modelo
  - Persistencia: Los datos que deben persisitir a lo largo del funcionamiento y ejecución del programa se envían al SGBD MySQL
  

* LENGUAJE UBIQUO: 
  El lenguaje usado ha sido ubiquo en el sentido que ha sido un lenaguje común entre los programadores y los usuarios, esto es:
  la definición de nombres, variables, funciones, clases, etc son autoexplicativas. Por ejemplo, los verbos indican acciones que se realizan (métodos) mientras que
  los sustantivos representan objetos sobre los cuales se realiza esas operaciones.
  y por lo tanto se pudo implemntar el codigo desde el diseño de la mejor forma y haciendo una representación fiel de lo que es la realidad.
  Además se pudo basar los diseños complejos en un modelo en específico, iniciar una creativa colaboración entre técnicos y expertos del dominio para interactuar lo más cercano posible a los conceptos fundamentales del problema. Ejemplo: Las variables usadas son autoexplicativas:
  
```
echo "<th scope=\"row\"> ";
   echo $registro1["id_sesion"];
echo "</th>";
  echo "<td>";
    echo $registro1["fecha"];
  echo "</td>";
  echo "<td>";
    echo $registro1["hora"];
  echo "</td>";
  echo "<td>";
    echo $registro1["nombre_votacion"];
  echo "</td>";
```
* BOUNDED CONTEXT:
  Sirve para acotar los distintos dominios que hay, esto es, delimitar conceptos en cada parte del dominio agrupando elementos que están relacionados. 
  Se hizo esto al modularizar la logica de funcionamiento en archivos, clases, funciones, etc.
