# apiCreator
Estoes un creador de API hecho con html, css y javascript para crear las variables con la información necesaria para crearlas y luego ir corriendo los scripts de los diferentes archivos php para generar la carpeta api/v1

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

todoCreator.php no es un script sino que tiene las variables que usa cada uno de los creadores para ordenarse