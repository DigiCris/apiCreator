<?php

// Crear configvars.php usando la carpeta programa. Entrando por index.html te va llevando por las diferentes secciones
// se va guardando las variables en localstorage, al finalizar se hace un download del archivo generado
// ese archivo guardarlo en la carpeta principal como configvars.php, que tiene todas las variables necesarias para crear la api con los scripts en php.
// El hadlerCreator es el entry point del script, Luego te va llevando por el resto clickeando en el link
// Verificar que no haya warnings ni notice al correrlo, sino puede haber problema con el nombre de una variable
// al finalizar se genera el directorio API con todo generado. No está probado
// el swaggerCreator aún no está armado. el japi.json solo es un prototipo para ver como comenzar a armar el swagger
// con la info que está en configvars.php
// también habría que buscar poder crear diferentes secciones de la API, cargar cosas ya armadas, levantar configvars.php
// de cosas ya armadas, etc.

/////////////////////// Handler Handler.php////////////////////////////////////////////////////

$nombreDeLaTabla = "info"; // Nombre de la tabla que estoy tratado
$nombreArchivo = $nombreDeLaTabla."Handler.php"; // nombre del archivo
$rutaArchivo = $nombreDeLaTabla."/".$nombreArchivo; // acá es donde estará el archivo
$texto = ''; // aca voy guardando las diferentes secciones del archivo
$columnas = array( // descripcion de variable, nombre de la variable, tipo de la variable, caracteristicas de la variable (regular= normal, autoincrement= id autoincrementales, encrypted= si quiero que el campo este encriptado, aunque este aún no lo resolvi)
    array("link to the webinar/news", "link", "string","rsa"),
    array("autoincremental identifier. 1 unique id for each webinar/news.", "id", "uint","autoincrement"),
    array("the title (name) of the webinar/news.", "title", "string","PASSWORD_BCRYPT")
);
$update = array( //que actualiza, cual es el identificador de la busqueda
    array("all", "id"),
    array("all", "link"),
    array("all", "title"),
    array("title", "id")
); // = UpdateFunctions
$read = array( //que lee
    "all",
    "link",
    "id",
    "title"
);
$delete = array( //que Borra
    "all",
    "link",
    "id"
);
$login = array(
    "user",
    "password",
    "PASSWORD_BCRYPT"
);
$claves = array( //privada, publica, extractos de la clave privada que saco y reemplazo por claves a mandar
    "-----BEGIN RSA PRIVATE KEY-----
    ...
    -----END RSA PRIVATE KEY-----",
    "p-----BEGIN PUBLIC KEY-----
    ...
    -----END PUBLIC KEY-----",
    "40-46;200-205;494-500" // entre 40 y 500. El - dice de donde hasta donde saca y ; separa claves. Siempre sacará una letra más que la resta que haga de ambos numeros separados por .
);

///////////////////////////////////// Functions api/v1/functions ////////////////////////////////////////////

$columnas = array( // descripcion de variable, nombre de la variable, tipo de la variable, caracteristicas de la variable (regular= normal, autoincrement= id autoincrementales, encrypted= si quiero que el campo este encriptado, aunque este aún no lo resolvi)
    array("link to the webinar/news", "link", "string","rsa"),
    array("autoincremental identifier. 1 unique id for each webinar/news.", "id", "uint","autoincrement"),
    array("the title (name) of the webinar/news.", "title", "string","PASSWORD_BCRYPT")
);
$nombreDeLaTabla = "info"; // Nombre de la tabla que estoy tratado

// el ultimo en setear ya que  no puedo borrar los campos que aparezcan aca en el primer field
// si estos aparecen en el primer field de delete o en el segundo de updates.
// eso los vamos a dejar con un input inmodificable
$ReadFunctions = array(
    array("all", "Reads all ".$nombreDeLaTabla." table"),
    array("id", "Reads row in ".$nombreDeLaTabla." serched by id"),
    array("title", "Reads row in ".$nombreDeLaTabla." serched by title")
);

$DeleteFunctions = array(
    array("all", "Deletes all ".$nombreDeLaTabla." table"),
    array("id", "Deletes row in ".$nombreDeLaTabla." serched by id"),
    array("title", "Deletes row in ".$nombreDeLaTabla." serched by title")
);


$WriteFunctions = array( // name del archivo y funcion, Variable por la que busca la existencia antes de hacer el write
    "setComplete", "id"
);


$UpdateFunctions = array(
    array("all","id"),
    array("all","id"), //title
    array("all","title"), // link
    array("title","id") // link
);

//////////////////////////// HTACCESS .htaccess ////////////////////////////////////////

$nombreDeLaTabla = "info"; // Nombre de la tabla que estoy tratado
$texto = ''; // aca voy guardando las diferentes secciones del archivo

$get = array( // descripcion de variable, nombre de la variable, tipo de la variable, caracteristicas de la variable (regular= normal, autoincrement= id autoincrementales, encrypted= si quiero que el campo este encriptado, aunque este aún no lo resolvi)
    array("all","", "Read all ".$nombreDeLaTabla,"auth0"), //getAll
    array("","id", "Read ".$nombreDeLaTabla." by id.","auth0,auth1"), // getById
    array("","title", "Read all Title of ".$nombreDeLaTabla,"") // getByTitle
    //array("title","id", "Read Titles of ".$nombreDeLaTabla." by id.","auth1") // getTitleById
);


/////////////////////////// Index index.php/////////////////////////////////////////////

$nombreDeLaTabla = "info"; // Nombre de la tabla que estoy tratado
$texto = ''; // aca voy guardando las diferentes secciones del archivo
$rutaArchivo = $nombreDeLaTabla."/index.php";
$columnas = array( // descripcion de variable, nombre de la variable, tipo de la variable, caracteristicas de la variable (regular= normal, autoincrement= id autoincrementales, encrypted= si quiero que el campo este encriptado, aunque este aún no lo resolvi)
    array("link to the webinar/news", "link", "string","rsa"),
    array("autoincremental identifier. 1 unique id for each webinar/news.", "id", "uint","autoincrement"),
    array("the title (name) of the webinar/news.", "title", "string","PASSWORD_BCRYPT")
);
$post = array( // descripcion de variable, nombre de la variable, tipo de la variable, caracteristicas de la variable (regular= normal, autoincrement= id autoincrementales, encrypted= si quiero que el campo este encriptado, aunque este aún no lo resolvi)
    array("set","complete","", "Insert a new row","authSet,authProc","title"), //setComplete
    array("delete","all","", "delete all table","authDel",""), // deleteAll
    array("delete","","id", "delete all that matches Id ","authDel","id"), //deleteById
    array("update","all","id", "Updates all that matches Id","authUpdate","id"), //updateAllById
    array("update","title","id", "Updates title that matches Id","authUpdate","id,title") //updateTitleById
);
$get = array( // descripcion de variable, nombre de la variable, tipo de la variable, caracteristicas de la variable (regular= normal, autoincrement= id autoincrementales, encrypted= si quiero que el campo este encriptado, aunque este aún no lo resolvi)
    array("all","", "Read all ".$nombreDeLaTabla,"auth0"), //getAll
    array("","id", "Read ".$nombreDeLaTabla." by id.","auth0,auth1"), // getById
    array("","title", "Read all Title of ".$nombreDeLaTabla,"") // getTitle
    //array("title","id", "Read Titles of ".$nombreDeLaTabla." by id.","auth1") // getTitleById
);


////////////////////////////// lib lib.php ///////////////////////////////////////////

$nombreDeLaTabla = "info"; // Nombre de la tabla que estoy tratado

$source = "./".$nombreDeLaTabla."";
$destination = "api/v1/".$nombreDeLaTabla."";
$texto = "";

///////////////////////////////// auth auth.php //////////////////////////////////////////

$auths = array( // nombre, tipos, condiciones de autentificacion
    array("authSet","rol|sesion","rol>2|id"),
    array("authProc","proc","http://comunyt.com"),
    array("authDel","rol","role>4"),
    array("authUpdate","sesion","id"),
);

////////////////////////////////// Config configuracion.php //////////////////////////////
$DBNAME = "...";
$DBUSER = "...";
$DBPASSWD = "...";

/////////////////////////////// Table table.sql mysql base de datos  BBDD DB//////////////////////
$nombreDeLaTabla = "info"; // Nombre de la tabla que estoy tratado

//($nombre, $tipo, $longitud = null, $predeterminado = null, $nulo = true, $autoincremental = false, $descripcion = null, $primary = false)
$columnasSQL = array(
    array("id", "INT", 11, null, false, true, "autoincremental | 1 unique id for each webinar/news.", true),
    array("link", "VARCHAR", 50, null, true, false, "rsa | link to the webinar/news",false),
    array("title", "VARCHAR", 50, null, true, false, "PASSWORD_BCRYPT | the title (name) of the webinar/news.",false)
);







?>