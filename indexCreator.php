<?php
    /*functions
    createDirectory($directoryName)
    deleteDirectory($directory)
    createFileInDirectory($directory, $fileName)
    writeToFile($text, $fileName)
    moveDirectory($source, $destination)
    */
    include_once "./stdio.php";
    $texto = ''; // aca voy guardando las diferentes secciones del archivo



    //createFileInDirectory($nombreDeLaTabla, "index.php");// este estaba antes, con el orden de ejecucion lo cambie ahora por el de abajo
    createFileInDirectory("api/v1/".$nombreDeLaTabla, "index.php");
    createMethodSelector($nombreDeLaTabla);
    createGets($get,$columnas,$nombreDeLaTabla);
    createPosts($post,$columnas,$nombreDeLaTabla);

    writeToFile($texto, "api/v1/".$nombreDeLaTabla."/index.php");
    //writeToFile($texto, $nombreDeLaTabla."/index.php"); // este estaba antes, con el orden de ejecucion lo cambie ahora por el de arriba



    echo "<br><br>Disfruta de la API";


// getTitle o getTitleById son busquedas especificas y yo por ahora lo que obtengo son getAll o getById (que sería un getAllById)
// este documento si está preparado para generarlas pero no el functionCreator.php

// Luego = htaccess en info, htaccess fuera de info, auth, configuracion, lib, creacion de tablas sql
// Unir todo en una sola interfaz

    /* Aca comienzo con las funciones */

//array("update","title","id", "Updates title that matches Id","authUpdate","campos,obligatorios") //updateTitleById
function createPosts($post,$columnas,$tabla) {
    global $texto;

    $endpointDescription = "";
    $cases = "";
    foreach($post as $endpoint) {
        $endpointName = $endpoint[0].ucfirst($endpoint[1]);
        if(strlen($endpoint[2])>0) {
            $endpointName .= "By".ucfirst($endpoint[2]);
        }
        $endpointDescription .= "\n*    '".$endpointName."' -> ".$endpoint[3];

        $checkArray = explode(",", $endpoint[5]);
        
        $checkCases = '';
        
        foreach ($checkArray as $check) {
            if($check!="") {
                $checkCases .= "
            if(!isset(\$post['".$check."'])) {
                \$result['success'] = false;
                \$result['msg'] = 'No ".$check." to ".$endpoint[0].".';
                break;
            }";
            }else {
                $checkCases .= "";
            }
        }
        $folder = $endpoint[0];
        if($folder == "set") {
            $folder = "write";
        }

        switch($endpoint[0]){

            case "set":
                $arg = "\$post['".$columnas[0][1]."']";
                foreach($columnas as $columna) {
                    if( $arg != ("\$post['".$columna[1]."']") ) {
                        $arg .= ", \$post['".$columna[1]."']";
                    }
                }
                break;

            case "update": //UpdateFunction => endpoint
                if($endpoint[1]=="all") {
                    $arg = "\$post['".$columnas[0][1]."']";
                    foreach($columnas as $columna) {
                        if($columna[1]!=$columnas[0][1]) {
                            $arg .= ", \$post['".$columna[1]."']";
                        }
                    }          
                }else {
                    $arg = "\$post['".$endpoint[2]."']";
                }
                break;

            case "delete":
                if($endpoint[1]=="all") {
                    $arg ="";
                }else {
                    if(strlen($endpoint[2])>0) {
                        $arg = "\$post['".$endpoint[2]."']";
                    }
                }
        }



        $autentificacion = '';

        $authArray = explode(",", $endpoint[4]);
        foreach ($authArray as $authAux) {
            if(strlen($authAux)>0)
                $autentificacion .= "\n            ".$authAux . "();";
        }     


        
//$post['kind']
        $cases .= "
        case '".$endpointName."':".$autentificacion."
            debug('I am inside the post method ".$endpointName." <br>');
            include_once 'functions/".$folder."/".$endpointName.".php';".$checkCases."
            \$result = ".$endpointName."(".$arg.");
            break;
        ";


    }
    $cols = "";
    $endpointParam = "";
    $endpointRet = "";
    foreach($columnas as $columna) {
        $endpointParam .= "\n* \param \$post['".$columna[1]."'] (".$columna[2].") ".$columna[0];
        $endpointRet .= "\n*    ['".$columna[1]."'] (".$columna[2].") ".$columna[0];
        $cols .= $columna[1]."/";
    }



    $texto .= "
/*!
* \brief    Endpoints of the post method.
* \details  It has a switch that reads the post method, which connects to the corresponding endpoint (set, delete or update).
* \param \$post['method'] (string) Specifies the method that connects to the corresponding post endpoints. ".$endpointDescription.$endpointParam."
* \\return \$result['response'] (array) An array with the requested ".$tabla." information.".$endpointRet."
* \\return \$result['success'] (bool) Returns true if the request was succesful, false if not.
* \\return \$result['msg'] (string) Returns a message explaining the status of the execution.
*   '".$tabla." uploaded.' -> When the execution was successful, the ".$tabla." information was uploaded in the database.
*   'This ".$tabla." could not be uploaded. Try again later.' -> When the call fails, it could be because it couldn't connect to the database. 
*   'This ".$tabla." row is already in the database.' -> When trying to insert something that already exists inside the database.
*   'Updated' -> When the updateing execution was successful, the ".$tabla." information was updated in the database.
*   'We couldn't update. Try again later' -> When the update fails, it could be because it couldn't connect to the database. 
*   'We couldn't find what you are trying to update.' -> When the information of ".$tabla." you want to update does not exist or it is not found in the database.
*   '".$tabla." row deleted' -> When was able to delete the fetched ".$tabla." row/rows.
*   'It was not possible to erase the ".$tabla.". Try again later' -> When it fails to eliminate the ".$tabla." row/rows.
*   'This".$tabla." row did not exist.' -> When the ".$tabla." row was not found or did not exist.
*   'No ".$cols." to set.' -> When one of the required parameters is missing.
*   'No selection to delete.' -> When \$post['selection'] is missing (in method deleteBySelection).
*   'No selection to update.' -> When \$post['selection'] is missing (in method update...BySelection).
*   'No valid case selected' -> When a method that does not exist is selected (in the default of the switch). 
*/  
function postFunctions(\$post) {
    switch (\$post['method']) {
        ".$cases."
        default:
            \$result['success']=false;
            \$result['msg']='No valid case selected';
            break;
    }
    return \$result;
}

?>
    ";
}

































function createGets($get,$columnas,$tabla) {
    global $texto;
    $i=0;

    $endpointName = array();
    $endpointNameArg = array();
    $endpointDescription = "";
    $param = "";
    $ret = "";
    $specificRet = "";
    $cases = "";

    foreach($get as $endpoint) {
        $endpointName[$i] = "get".ucfirst($endpoint[0]);
        $endpointNameArg[$i] = "";
        if($endpoint[1]!="") {
            $endpointName[$i] .= "By".ucfirst($endpoint[1]);
            $endpointNameArg[$i] = "\$get['".$endpoint[1]."']";
            $param .= "\n* \param \$get['".$endpoint[1]."'] searching variable of the ".$tabla." table to read (in method ".$endpointName[$i].").";
            $specificRet .= "*   'No ".$endpoint[1]." selected to read.' -> When ".$endpoint[1]." is missing (in method ".$endpointName[$i].").\n";
            $caseBy = "
            if(!isset(\$get['".$endpoint[1]."'])) {
                \$result['success'] = false;
                \$result['msg'] = 'No ".$endpoint[1]." selected to read.';
                break;
            }";
        } else {
            $caseBy = "";
        }
        $endpointDescription .= "\n*    '".$endpointName[$i]."' -> ".$endpoint[2];
        // falta romper $endpoint[3]
        $autentificacion = '';

        $authArray = explode(",", $endpoint[3]);
        foreach ($authArray as $authAux) {
            if(strlen($authAux)>0)
                $autentificacion .= "\n            ".$authAux . "();";
        }            



        $cases .="
        case '".$endpointName[$i]."':".$autentificacion."
            include_once 'functions/read/".$endpointName[$i].".php';".$caseBy."
            \$result = ".$endpointName[$i]."(".$endpointNameArg[$i].");
            debug('".$endpointName[$i]."');
            break;
            ";
        $i++;
    }

    foreach($columnas as $columna) {
        $ret .= "    * ['".$columna[1]."'] (".$columna[2].") ".$columna[0]." (Special carachteristic => ".$columna[3].").\n";
    }




    $texto .= "
/*!
* \brief    Endpoints of the get method.
* \details  It has a switch that reads the get method, which connects to the corresponding endpoint.
* \param \$get['method'] (string) Specifies the method that connects to the corresponding get endpoints.".$endpointDescription.$param."
* \\return \$result['response'] (array) An array with the requested information of ".$tabla." table.
".$ret."* \\return \$result['success'] (bool) Returns true if the request was succesful, false if not.
* \\return \$result['msg'] (string) Returns a message explaining the status of the execution.
*   '".$tabla." fetched' -> When was able to read the fetched ".$tabla.".
".$specificRet."*   'No valid get case selected' -> When a method that does not exist is selected (in the default of the switch). 
*/
function getFunctions(\$get) {
    debug(\$get['method']);
    switch (\$get['method']) {
        ".$cases."
        default:
            \$result['success']=false;
            \$result['msg']='No valid get case selected';
            break;
    }
    return \$result;
        
}
        
";
}













function createMethodSelector($tabla) {
    global $texto;

    $texto .= "
    <?php

    include_once '../configuracion.php';
    include_once '../lib.php';

    debug('I am ".$tabla." <br>');
    setPostWhenMissing();
    debug(\$_POST);

    switch (\$_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if(!isset(\$_POST['method'])) {
                \$result['success']=false; // I write the error directly in the result
                \$result['msg']='no post method especified';
            }else {
                \$result = postFunctions(\$_POST);
            }
            \$result=json_encode(\$result);
            echo \$result;
            break;
        
        case 'GET':
            if(!isset(\$_GET['method'])) {
                \$result['success']=false; // I write the error directly in the result
                \$result['msg']='no get method especified';
            }else {
                \$result = getFunctions(\$_GET);
            }
            \$result=json_encode(\$result);
            echo \$result;
            break;

        default:
            \$result['success']=false;
            \$result['msg']='Invalid REQUEST_METHOD (GET or POST)';
            \$result = json_encode(\$result);
            echo \$result;
            break;
    }
    ";
}








?>