<?php
/*functions
createDirectory($directoryName)
deleteDirectory($directory)
createFileInDirectory($directory, $fileName)
writeToFile($text, $fileName)
*/
include_once "./stdio.php";


createDirectory($nombreDeLaTabla."/functions");
createDirectory($nombreDeLaTabla."/functions/read");
createDirectory($nombreDeLaTabla."/functions/delete");
createDirectory($nombreDeLaTabla."/functions/write");
createDirectory($nombreDeLaTabla."/functions/update");

generarReadFiles($ReadFunctions,$columnas,$nombreDeLaTabla);
generarDeleteFiles($DeleteFunctions,$columnas,$nombreDeLaTabla);
generarWriteFiles($WriteFunctions,$columnas,$nombreDeLaTabla);

generarUpdateFiles($UpdateFunctions,$columnas,$nombreDeLaTabla);

echo "<br><br><a href='htaccessCreator.php'>Go to htaccess creator</a>";


function generarUpdateFiles($UpdateFunctions,$columnas,$tabla) {
    foreach($UpdateFunctions as $UpdateFunction) {
        $fileName = "update".ucfirst($UpdateFunction[0])."By".ucfirst($UpdateFunction[1]);
        if($UpdateFunction[0]=="all") {
            $text = updateAllTextGen($UpdateFunction,$columnas,$tabla,$fileName);
            createFileInDirectory($tabla."/functions/update", $fileName.".php");
            writeToFile($text, $tabla."/functions/update/".$fileName.".php");             
        }else {
            $text = updateByTextGen($UpdateFunction,$columnas,$tabla,$fileName);
            createFileInDirectory($tabla."/functions/update", $fileName.".php");
            writeToFile($text, $tabla."/functions/update/".$fileName.".php");  
        }
       
    }

}


// Falta crear esta function que al igual que updateAllTextGen debe crear el texto pero solo para hacer update de un campo de la tabla
function updateByTextGen($UpdateFunction,$columnas,$tabla,$fileName) {

    $text = "
<?php 

include_once '".$tabla."Handler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update ".$UpdateFunction[0]." by ".$UpdateFunction[1]." inside a row in the databse.
* \details  Defines a new ".$UpdateFunction[0]." in the database of ".$tabla." stored in the database, which is searched by ".$UpdateFunction[1].".
* \param    $".$UpdateFunction[1]." The field of the ".$tabla." table that I want to use to search.
* \param    $".$UpdateFunction[0]." The value in ".$tabla." table that I want to update.
* \\return   \$success  (array) Returns an array with different success states.
*/

function ".$fileName."($".$UpdateFunction[1].", $".$UpdateFunction[0].")
{
    debug ('i am in update".ucfirst($UpdateFunction[1])."By".ucfirst($UpdateFunction[0])."');

    \$information = new ".$tabla."();
    \$success['response'] = \$information->read".ucfirst($UpdateFunction[1])."($".$UpdateFunction[1].");

    if(\$success['response']['".$UpdateFunction[1]."'] == $".$UpdateFunction[1].")
    {
        \$information->set_".$UpdateFunction[0]."($".$UpdateFunction[0].");
        \$success['response'] = \$information->".$fileName."($".$UpdateFunction[1].");
        \$success['response'] = \$information->read".ucfirst($UpdateFunction[1])."($".$UpdateFunction[1].");
        if(\$success['response']['".$UpdateFunction[0]."'] == $".$UpdateFunction[0].")
        {
            \$success['success'] = true;
            \$success['msg'] = 'Updated.';
        }
        else
        {
            \$success['success'] = false;
            \$success['msg'] = 'We could not update. Try again later.'; 
        }
    }
    else
    {
        \$success['success'] = false;
        \$success['msg'] = 'We could not find the ".$UpdateFunction[1]." you are trying to update.';
    }

    return \$success;
}

?>    
    ";
    return $text;
}



// Esta funcion se escribió por completo, Se verificó que compile pero no se corrigió formato ni verifico que estuviera bien creado. terminarlo
function updateAllTextGen($UpdateFunction,$columnas,$tabla,$fileName) {

    $arg = "$".$columnas[0][1];
    $geter = "";
    $param = "";
    $seter = "";
    $ret = "";
    if($columnas[0][1]==$UpdateFunction[1]) {
        $geter .= "'".$columnas[0][1]."' => $".$columnas[0][1];
    } else {
        $geter .= "'".$columnas[0][1]."' => \$register->get_".$columnas[0][1]."()";
    }
    $takeGetter=false;
    foreach($columnas as $columna) {
        if($columna[1]==$UpdateFunction[1]) {
            $param .= "\n* \param      $".$columna[1]."       (".$columna[2].")    Identifier of the ".$tabla." to update. ".$columna[0];
            if($takeGetter) {
               $geter .= ",\n               '".$columna[1]."' => $".$columna[1]; 
            }
            $takeGetter=true;
        } else {
            $param .= "\n* \param      $".$columna[1]."     (".$columna[2].")  ".$columna[1]." to update. ".$columna[0];
            if($takeGetter) {
                $geter .= ",\n               '".$columna[1]."' => \$register->get_".$columna[1]."()";
            }
            $takeGetter=true;
        }
        $ret .= "\n     ** ['".$columna[1]."']        (".$columna[2].")   ".$columna[3].".";
        if($columna[1]!=$columnas[0][1]) {
            $arg .= ", $".$columna[1];
        }
        $seter .= "\n        \$register->set_".$columna[1]."($".$columna[1].");";
    }

    $argRand = $columnas[0][1];
    while($argRand == $columnas[0][1]) {
        srand(microtime(true) * 1000 + getmypid());
        $argRand = $columnas[array_rand($columnas)][1];
    }
    


$text = "<?php

include_once '".$tabla."Handler.php';

/*!
* \brief        Update all row information.
* \details      Update the information of ".$tabla." table, searching it by ".$UpdateFunction[1].".".$param."
* \\return      \$success['response'] (array) An array with the updated fields of the ".$tabla.".".$ret."
* \\return      \$success['success'] (bool) Returns true if the ".$tabla." was updated, false if not.
* \\return      \$success['msg'] (string) Returns a message explaining the status of the execution.
    * \\return •    '".$tabla." updated' -> When the execution was succesful, the ".$tabla." has been updated.
    * \\return •    'We could not update. Try again later.' -> When the update failed, it could be because it couldn't connect to the database.
    * \\return •    'We could not find the ".$UpdateFunction[1]." you are trying to update.' -> When the ".$tabla."'s field ".$UpdateFunction[1]." does not exist or it is not found in the database.
*/

function $fileName($arg) {
    \$register = new ".$tabla."();

    \$success['response'] = \$register->read".ucfirst($UpdateFunction[1])."($".$UpdateFunction[1].");

    if(\$success['response']['".$UpdateFunction[1]."'] == $".$UpdateFunction[1].") {
        ".$seter."

        \$success['response'] = \$register->updateAllBy".ucfirst($UpdateFunction[1])."($".$UpdateFunction[1].");
        \$success['response'] = \$register->read".ucfirst($UpdateFunction[1])."($".$UpdateFunction[1].");
        if(\$success['response']['".$argRand."'] == $".$argRand." and \$success['response']['".$UpdateFunction[1]."'] == $".$UpdateFunction[1].") {
            // I prepare the inserted data (encrypted) to show
            \$data = array (
               ".$geter."
            );
            \$success['response'] = \$data;
            \$success['success'] = true;
            \$success['msg'] = '".$tabla." updated';
        }else {
            \$success['success'] = false;
            \$success['msg'] = 'We could not update. Try again later.';
        }
    }else {
        \$success['success'] = false;
        \$success['msg'] = 'We could not find the ".$UpdateFunction[1]." you are trying to update.';
    }
    return \$success;
}
    
?>    
    ";

    return $text;
}









function generarWriteFiles($WriteFunctions,$columnas,$tabla) {

    $arg = "$".$columnas[0][1]."=null";
    $geter = "";
    $seter = "";
    $param = "";
    $ret = "";
    $geter .= "\n              '".$columnas[0][1]."' => \$register->get_".$columnas[0][1]."()";
    foreach($columnas as $columna) {
        $param .= "\n*\param      $".$columna[1]." (".$columna[2].") ".$columna[0];
        $ret .= "\n** ['".$columna[1]."'] (".$columna[2].") The established ".$columna[1].".";
        if( $arg != ("$".$columna[1]."=null") ) {
            $arg .= ", $".$columna[1]."=null";
            $geter .= ",\n              '".$columna[1]."' => \$register->get_".$columna[1]."()";
        }
        $seter .= "\n        \$register->set_".$columna[1]."($".$columna[1].");";
    }
    $retNoDup = "";

    $textoDup = $seter."
        \$success['response'] = \$register->insert();
        if(\$success['response'] == false) {
            \$success['success'] = false;
            \$success['msg'] = 'This ".$tabla." could not be uploaded. Try again later.';
        }else {
            // I prepare the inserted data (encrypted) to show
            \$data = array ( ".$geter."
            );
            \$success['response'] = \$data;
            \$success['success'] = true;
            \$success['msg'] = '".$tabla." uploaded';
        }
    ";

    $textoNoDup = $textoDup;
    if(count($WriteFunctions)>1) { // existe una variable que no permite duplicacion
        $noDup = "$".$WriteFunctions[1];
        $retNoDup = "\n** \\return • 'The ".$WriteFunctions[1]." already exists' -> When the ".$noDup." of the ".$tabla." already exists in the database. ";
        $textoNoDup = "if( count(\$register->read".ucfirst($WriteFunctions[1])."($".$WriteFunctions[1].")) > 0 ) {".$textoDup."}else {
        \$success['success'] = false;
        \$success['msg'] = 'The ".$WriteFunctions[1]." already exists';
    }";
    }


        $text = "
<?php

include_once '".$tabla."Handler.php';

/*!
* \brief      Create a new ".$tabla." row.
* \details    Insert a new ".$tabla." an it's information in the database. Some fields might encrypt.".$param." 
* \\return \$success['response'] (array) An array with the established ".$tabla." fields.".$ret."
* \\return \$success['success'] (bool) Returns true if the new ".$tabla." row was inserted, false if not.
* \\return \$success['msg'] (string) Returns a message explaining the status of the execution.
** \\return • '".$tabla." uploaded' -> When the execution was succesful, the new ".$tabla." row was uploaded in the database.
** \\return • 'This ".$tabla." could not be uploaded. Try again later.' -> When the insert failed, it could be because it couldn't connect to the database.".$retNoDup."
*/
function ".$WriteFunctions[0][0]."($arg) {
    \$register = new ".$tabla."();
    ".$textoNoDup."
    return \$success;
}

?>
";
    createFileInDirectory($tabla."/functions/write", $WriteFunctions[0][0].".php");
    writeToFile($text, $tabla."/functions/write/".$WriteFunctions[0][0].".php");

}























function generarDeleteFiles($ReadFunctions,$columnas,$tabla) {
    foreach($ReadFunctions as $ReadFunction) {
        $brief = "* \brief       ".$ReadFunction[1]."";
        if($ReadFunction[0]=="all") {
            $fileName="deleteAll";
            $params = "* \param       (void) No param required.";
            $arg = "";
            $details = "* \details     Search in the database all ".$tabla." and delete it if it exists.";
            $call1= "readAll()";
            $call2= "deleteAll()";
        }else {
            $fileName="deleteBy".ucfirst($ReadFunction[0]);
            for($i=0;$i<=count($columnas);$i++) {
                if($ReadFunction[0]==$columnas[$i][1]) {
                    break;
                }
            }
            if($i<count($columnas)) {
                $type = "(".$columnas[$i][2].") ";
            }else {
                $type ="";
            }
            $params = "* \param       ".$type."".$ReadFunction[0]." The identifier of the row/rows in the ".$tabla." table to delete.";
            $arg = "$".$ReadFunction[0];
            $details = "* \details     Search in the database ".$tabla." that matches ".$ReadFunction[0]." and delete it if it exists.";
            $call1= "read".ucfirst($ReadFunction[0])."($".$ReadFunction[0].")";
            $call2= "deleteBy".ucfirst($ReadFunction[0])."($".$ReadFunction[0].")";
        }

        $text = "
<?php

include_once '".$tabla."Handler.php';

/*!
".$brief."
".$details."
".$params."
* \\return    \$success['response'] (bool) Returns true if the row/rows was/were deleted, false if not.
* \\return    \$success['success'] (bool) Returns true if the request was succesful, false if not.
* \\return    \$success['msg'] (string) Returns a message explaining the status of the execution.
** \\return • '".$tabla." deleted.' -> When was able to delete the ".$tabla." row/rows.
** \\return • 'It was not possible to erase the ".$tabla." row/rows requested. Try again later.' -> When it fails to delete the row.
** \\return • 'This ".$tabla." did not exist.' -> When the ".$tabla." ".$ReadFunction[0]." was not found or did not exist. 
*/
function $fileName(".$arg.") {
    \$register = new ".$tabla."();
    \$exists = \$register->$call1;

    if(count(\$exists) > 0) {
        \$success['response'] = \$register->$call2;
        \$exists = \$register->$call1;
        if(count(\$exists) > 0) {
            \$success['success'] = false;
            \$success['msg'] = 'It was not possible to erase the ".$tabla." row/rows requested. Try again later.';
        }else {
            \$success['success'] = true;
            \$success['msg'] = '".$tabla." deleted.';
        }
    }else {
        \$success['success'] = false;
        \$success['msg'] = 'This ".$tabla." did not exists.';
    }
    return \$success;
}
        
?>
    ";
    createFileInDirectory($tabla."/functions/delete", $fileName.".php");
    writeToFile($text, $tabla."/functions/delete/".$fileName.".php");

    }
}





function generarReadFiles($ReadFunctions,$columnas,$tabla) {
    foreach($ReadFunctions as $ReadFunction) {
        $brief = "* \brief       ".$ReadFunction[1]."";
        if($ReadFunction[0]=="all") {
            $fileName="getAll";
            $params = "* \param       (void) No param required.";
            $arg = "";
            $details = "* \details     Search in the database all ".$tabla." and returns them in an array.";
            $call= "readAll()";
        }else {
            $fileName="getBy".ucfirst($ReadFunction[0]);
            for($i=0;$i<=count($columnas);$i++) {
                if($ReadFunction[0]==$columnas[$i][1]) {
                    break;
                }
            }
            if($i<count($columnas)) {
                $type = "(".$columnas[$i][2].") ";
            }else {
                $type ="";
            }
            $params = "* \param       ".$type."".$ReadFunction[0]." searching table by matching it.";
            $arg = "$".$ReadFunction[0];
            $details = "* \details     Search in the database ".$tabla." that matches ".$ReadFunction[0]." and returns them in an array.";
            $call= "read".ucfirst($ReadFunction[0])."($".$ReadFunction[0].")";
        }

        $ret = "* \\return     \$success['response'][N] (array) Returns the ".$tabla."s, where 'N' that indicates the position of the array to which the information about each ".$tabla." belongs.";
        foreach($columnas as $columna) {
            $ret .= "\n     ** ['".$columna[1]."']       (".$columna[2].")   ".$columna[0]."";
        }
        $ret .= "";


        $text = "
<?php

include_once '".$tabla."Handler.php';
/*!
".$brief."
".$details."
".$params."
".$ret."
* \\return      \$success['success'] (bool) Returns true if the request was succesful, false if not.
* \\return      \$success['msg'] (string) Returns a message explaining the status of the execution.
* * \\return • '".$tabla."s fetched.' -> When was able to read all the ".$tabla."s in the database.
* * \\return • 'We could not fetch the ".$tabla."s.' -> When there are no ".$tabla."s loaded in the database or it could not be connected to it.
*/
function $fileName($arg) {
    \$register = new ".$tabla."();
    \$success['response'] = \$register->$call;

    if(\$success['response']) {
        \$success['success'] = true;
        \$success['msg'] = '".$tabla."s fetched.';
    }else {
        \$success['success'] = false;
        \$success['msg'] = 'We could not fetch the ".$tabla."s.';
    }
    return \$success;
}
    
?>
    ";
    createFileInDirectory($tabla."/functions/read", $fileName.".php");
    writeToFile($text, $tabla."/functions/read/".$fileName.".php");

    }
}

?>