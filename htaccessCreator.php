<?php
    /*functions
    createDirectory($directoryName)
    deleteDirectory($directory)
    createFileInDirectory($directory, $fileName)
    writeToFile($text, $fileName)
    */
    include_once "./stdio.php";
    $texto = ''; // aca voy guardando las diferentes secciones del archivo


    createFileInDirectory($nombreDeLaTabla, ".htaccess");
    createHtaccess($get,$nombreDeLaTabla);
    writeToFile($texto, $nombreDeLaTabla."/.htaccess");

    echo "<br><br><a href='libCreator.php'>Go to lib creator</a>";


    function createHtaccess($get,$tabla) {
        global $texto;
        $rewrite="";
        foreach($get as $endpoint) {
            $nombre = "get".ucfirst($endpoint[0]);
            if($endpoint[1]!="") {
                $nombre .= "By".ucfirst($endpoint[1]);
                $rewrite .= "RewriteRule ^(".$nombre.")/(.+)$ index.php?method=$1&".$endpoint[1]."=$2 
";
            }
        }

        $texto = "Options -MultiViews
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
".$rewrite."RewriteRule ^([a-zA-Z0-9]+)$ index.php?method=$1";
    }

?>