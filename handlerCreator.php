<?php

include_once "./stdio.php";
$texto = ''; // aca voy guardando las diferentes secciones del archivo
/*
$claves = array( //privada, publica, extractos de la clave privada que saco y reemplazo por claves a mandar
    "-----BEGIN RSA PRIVATE KEY-----
    ...
    -----END RSA PRIVATE KEY-----",
    "p-----BEGIN PUBLIC KEY-----
    ...
    -----END PUBLIC KEY-----",
    "40-46;200-205;494-500" // entre 40 y 500. El - dice de donde hasta donde saca y ; separa claves. Siempre sacará una letra más que la resta que haga de ambos numeros separados por .
);
*/

$nombreArchivo = $nombreDeLaTabla."Handler.php";
$rutaArchivo = $nombreDeLaTabla."/".$nombreArchivo; // acá es donde estará el archivo


createDirectory($nombreDeLaTabla);
createFileInDirectory($nombreDeLaTabla, $nombreArchivo);
generarHeader($columnas,$nombreDeLaTabla);
generarDefinicionDeVariables($columnas);
generarSetersDeVariables($columnas);
generarGetersDeVariables($columnas);
generarConstructorConexionBBDD('localhost');
generarInsert($columnas,$nombreDeLaTabla);
generarUpdates($columnas,$update,$nombreDeLaTabla);
generarReads($columnas,$read,$nombreDeLaTabla);
generarDeletes($delete,$nombreDeLaTabla);
generarLoginVerifier($login,$nombreDeLaTabla);
generarRSA($claves,$columnas);
generarFooter();
writeToFile($texto, $rutaArchivo);

echo "<br><br><a href='functionCreator.php'>Go to function creator</a>";






// Funciones especificas

function generarFooter() {
    global $counter;
    global $texto;
    echo "".$counter.")";
    $texto .= "
}

?>";

    echo " Generó la etiqueta php de apertura, documentacion de variables de la clase y abrío la clase <br>";
    $counter++; 

}

function generarHeader($columnas,$nombreDeLaTabla) {

    global $counter;
    global $texto;
    echo "".$counter.")";

    $parametros="";
    foreach($columnas as $columna) {
        $parametros .= "\n * \param      $".$columna[1]."       (".$columna[2].")   ".$columna[0];
    }


    $texto .= "<?php

    include_once '../configuracion.php';
    
/*!
 * \brief      Handler for ".$nombreDeLaTabla.".
 * \details    It has every function to interact with the ".$nombreDeLaTabla." in the database (Create, read, update, delete)".$parametros."
 */
class user
{
    ";

    echo " Generó la etiqueta php de apertura, documentacion de variables de la clase y abrío la clase <br>";
    $counter++;  

}










function generarRSA($claves, $columnas) {

    $flag=false;
    foreach($columnas as $columna) {
        if($columna[3]=="rsa") {
            $flag = true;
        }
    }
    if($flag==false) {
        return;
    }

    global $counter;
    global $texto;
    echo "".$counter.")";


    $texto .= "
/*!
 * \brief    Encrypt a message.
 * \details  Receives a message and returns it encrypted, using a public key.
 * \param    \$plainData (any) The message or data to encrypt.
 * \\return   \$finaltext  (string) Return the encrypted data in a base64 encoded format, as string.
 * \\return   'Cannot get public key' (string) When the openssl_get_publickey(\$publicPEMKey) function returns false, when fails to create an asymmetric key.
 * \\return   'Cannot Encrypt' (string) When the openssl_public_encrypt(\$plainData, \$finaltext, \$publicPEMKey) function fails trying to encrypt data.
 */
    private function encrypt_RSA(\$plainData) {
        \$publicPEMKey = '".$claves[1]."';

        \$publicPEMKey = openssl_get_publickey(\$publicPEMKey);
        if (!\$publicPEMKey) {
            return 'Cannot get public key';
        }
        \$finaltext = '';
        openssl_public_encrypt(\$plainData, \$finaltext, \$publicPEMKey);
        if (!empty(\$finaltext)) {
            openssl_free_key(\$publicPEMKey);
            return base64_encode(\$finaltext);
        } else {
            return 'Cannot Encrypt';
        }
    }\n\n
    ";
    [$claveModificada,$reemplazo,$claveGuardada] = borrarSecciones($claves[2], $claves[0]);
    $claveTodas="";
    $parametros="";
    for($i=0; $i<$reemplazo; $i++) {
        $claveTodas .= ", \$clave".$i;
        $parametros .= "\n* \param    \$clave".$i." (string) A part of the private key to decrypt (".$claveGuardada[$i].");";//$claveGuardada[$i];
    }

    $texto .= "
/*!
* \brief    Decrypt a message.
* \details  Receives encrypted data and decrypts it by using a private key.
* \param    \$data (any) The message or data to decrypt.".$parametros."
* \\return   \$finaltext  (string) Return the decrypted data.
* \\return   'Cannot Decrypt' (string) When the openssl_private_decrypt(\$data,\$finaltext,\$privatePEMKey) function fails to decrypt the message.
*/
    private function decrypt_RSA(\$data".$claveTodas.")
    {

        \$privatePEMKey = '".$claveModificada."';

        \$data = base64_decode(\$data);
        \$privatePEMKey = openssl_get_privatekey(\$privatePEMKey);
        \$finaltext = '';
        \$Crypted = openssl_private_decrypt(\$data, \$finaltext, \$privatePEMKey);
        if (!\$finaltext) {
            return 'Cannot Decrypt';
        } else {
            return \$finaltext;
        }
    }\n\n
    ";



    echo " Encrypt/decrypt rsa generado <br>";
    $counter++;    
}

// funcion interna para realizar decrypt cortando la clave privada y generando claves para no ser guardadas
function borrarSecciones($secciones, $texto) {
    $secciones = explode(";", $secciones); // Divide las secciones en un array
    
    $reemplazo = 0; // Inicializamos el contador de reemplazo

    $claveGuardada = array();

    foreach ($secciones as $seccion) {
        $rango = explode("-", $seccion); // Divide el rango de la sección en un array
        
        $inicio = $rango[0];
        $fin = $rango[1];
        $longitud = strlen($texto);
        $textoBorrado = substr_replace($texto, "", $inicio, $fin - $inicio + 1);
        $textoEliminado = substr($texto, $inicio, $fin - $inicio + 1);

        $claveGuardada[] = $textoEliminado;
    
        //echo "<br><br>texto borrado = $textoEliminado <br><br>";
        $texto = substr_replace($textoBorrado, "'.\$clave".$reemplazo.".'", $inicio, 0);
        $reemplazo++;
    }

    return [$texto,$reemplazo,$claveGuardada];
}





// loginVerifier

function generarLoginVerifier($login,$tabla) {

    global $counter;
    global $texto;
    echo "".$counter.")";


    if($login[2]=="PASSWORD_BCRYPT") {}
    $texto .= "
/*!
 * \brief    Login verifier.
 * \details  Send ".$login[0]." and ".$login[1]." to the database and verify if the ".$login[0]." exists. If so, check if the ".$login[1]." matches. 
 * \param    $".$login[0]." The ".$login[0]." to login.
 * \param    $".$login[1]." (string) The password of the user to login.
 * \\return   False (bool) Returns false if the name does not exist or password does not match.
 * \\return   \$row (array) Returns the row if the password matches.
*/
    public function login($".$login[0].", $".$login[1].")
    {
        \$query = 'select * from ".$tabla." where ".$login[0]."=?';
        \$result = \$this->base->prepare(\$query);
        \$result->execute(array($".$login[0]."));
        \$row = \$result->fetchAll(PDO::FETCH_ASSOC);
        \$result->closeCursor();
        if (\$row) {
            \$verifypass = password_verify($".$login[1].", \$row[0]['".$login[1]."']);
            if (\$verifypass) {
                return \$row[0];
            } else {
                return false;
            }
        }
        return \$row;
    } \n\n
    ";
    echo "LoginVerifier generado <br>";
    $counter++;    
}












// Define las variables de la clase para maniobrar en la base de datos.
function generarDefinicionDeVariables($columnas) {
    global $counter;
    global $texto;
    echo "".$counter.")";

    $texto .= "
/*!
* \brief    PDO instance for the database
*/
    private \$base;\n\n
    ";

    foreach ($columnas as $columna) {
        $texto .= "/*!
* \\brief    " . "(".$columna[2].")".$columna[0] . "
*/
    private $" . $columna[1] . ";\n\n";
    }
    echo "Variables generadas <br>";
    $counter++;
}

// Define todos los seters
function generarSetersDeVariables($columnas) {
    global $texto;

    global $counter;
    echo "".$counter.")";

    foreach ($columnas as $columna) {

        if($columna[3]=="sha256") {
            $codificacion = "\n        \$var = hash('sha256', \$var);";
        } elseif($columna[3]=="rsa") {
            $codificacion = "\n        \$var = encrypt_RSA(\$var);";
        } elseif($columna[3]=="PASSWORD_BCRYPT") {
            $codificacion = "\n        \$var = password_hash(\$var, PASSWORD_BCRYPT);"; //password_hash($this->password, PASSWORD_BCRYPT);
        } else {
            $codificacion = "";
        }

        $texto .= "
/*!
* \brief    Sets ".$columna[1]." for the caller instance.
* \details  The value received as a param is added to the ".$columna[1]." property of the instance of this class.
* \param \$var    (".$columna[2].") ".$columna[1]." I want to set.
* \\return   \$success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_".$columna[1]."(\$var) {
        \$success=true;$codificacion
        \$this->".$columna[1]."=\$var;
        return \$success;
    }
\n\n";
    }
    echo "Setters generados <br>";
    $counter++;
}


// Define todos los getters

function generarGetersDeVariables($columnas) {
    global $texto;

    global $counter;
    echo $counter.")";

    foreach ($columnas as $columna) {
        $texto .= "
/*!
* \brief    Gets ".$columna[1]." for the caller instance.
* \details  The ".$columna[1]." property of the instance in this class is returned.
* \param    (void) none param needed.
* \\return   \$this->".$columna[1]."  (".$columna[2].") returns the ".$columna[1]." already set in the instance of this class.
*/
    public function get_".$columna[1]."() {
        return(\$this->".$columna[1].");
    }
\n\n";
    }
    echo "Geters generados <br>";
    $counter++;
}






function generarConstructorConexionBBDD($host) {// localhost
    global $texto;

    global $counter;
    echo $counter.")";

        $texto .= "
/*!
* \brief    Constructor function.
* \details  Turns on the Database and connect it.
* \param    (void) non param needed.
* \\return   error  (void) Nothing is return really but if there is an error a message will be printed
*/
    public function __construct() {
        try
        {
            \$this->base = new PDO('mysql:host=".$host."; dbname='.DBNAME,DBUSER,DBPASSWD);
            \$this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            \$this->base->exec('SET CHARACTER SET utf8');
        }
        catch (Exception \$e) 
        {
            \$success['success'] = false;
            \$success['msg'] = \$e->getMessage();
            echo json_encode(\$success);
        }
    }
\n\n";

    echo "conexion base de datos generada <br>";
    $counter++;
}


// Crea la funcion para insertar datos a la tabla
function generarInsert($columnas,$tabla) {
    global $counter;
    global $texto;
    echo "".$counter.")";
    $query='';
    $pdoVar='';
    $QuestionMarks="";
    $preparation="";
    $execution="";

    foreach ($columnas as $columna) {
        if($columna[3]!="autoincrement") {
            if(strlen($pdoVar)!=0) {
                $pdoVar .= ",";
                $QuestionMarks .= ",";
                $execution .= ",";
            } else {
                $pdoVar = "\$query='insert into ".$tabla." ("; 
                $QuestionMarks = ") values (";
                $preparation = "        \$result= \$this->base->prepare(\$query);\n\n";
                $execution="        \$success = \$result->execute(array(";
            }
            $pdoVar .= $columna[1];
            $QuestionMarks .= "?";
            $preparation .= "       \$this->".$columna[1]." =       htmlentities(addslashes(\$this->".$columna[1]."));\n";
            $execution .= "\$this->".$columna[1]."";
        }
    }
    $query = $pdoVar.$QuestionMarks.")';\n";
    $preparation .= "\n"; //    ));
    $execution .= ")); \n
        \$result ->closeCursor();
            
        // I send success to handle mistakes
        return \$success;
    ";



        $texto .= "
/*!
* \brief    Add new data to the table.
* \details  Using PDO, htmlentities and addslashes, we insert the data contained in the instance of the callee class.
* \param    (void) non param needed.
* \\return   \$success  (bool) true if it has added the value, false in any other case.
*/
    public function insert() {
        //SQL query for insertion of the data saved in this instance
        ".$query.$preparation.$execution."
    }
    \n\n";
    
    echo "Insert into table generado <br>";
    $counter++;
}







// Crea la funcion para updates de datos a la tabla
function generarUpdates($columnas,$updates,$tabla) {
    global $counter;
    global $texto;
    echo "".$counter.")";


foreach ($updates as $update) {
   
    if($update[0]!="all") {


        $query = "\$query='update ".$tabla." set ".$update[0]."=? where ".$update[1]."=?'; \n";
        $preparation = "
        \$this->".$update[0]." =          htmlentities(addslashes(\$this->".$update[0]."));
        \$this->".$update[1]." =                   htmlentities(addslashes(\$".$update[1]."));
        ";

        $execution = "
        \$success = \$resultado->execute(array(\$this->".$update[0].", \$this->".$update[1]."));
        \$resultado ->closeCursor();

        // I send success to handle mistakes
        return \$success;";
    
            $texto .= "
/*!
* \brief    Update ".$update[0]." by ".$update[1].".
* \details  Using PDO, htmlentities and addslashes, we update the ".$update[0]." contained in the instance of the callee class.
* \param \$".$update[1]."    identifier of the table we want to change ".$update[0].".
* \\return   \$success  (bool) true if it has updated the value, false in any other case.
*/
    public function update".ucfirst($update[0])."By".ucfirst($update[1])."(\$".$update[1].") {
        //SQL query for updating
        ".$query.$preparation.$execution."
    }
    \n\n";


    }else {
        $query='';
        $pdoVar='';
        $cant = strlen($pdoVar);
        $preparation="";
        $execution=""; 
    foreach ($columnas as $columna) {
        if($cant!=0) {
            if($columna[1]!=$update[1]) {
                $pdoVar .= ", ";
                $execution .= ",";                
            }
        } else {
            $pdoVar = "\$query='update ".$tabla." set "; 
            $preparation = "        \$result= \$this->base->prepare(\$query);\n\n";
            $execution="        \$success = \$result->execute(array(";
        }
        if($columna[1]!=$update[1]) {
           $pdoVar .= $columna[1]."=?"; 
           $cant = strlen($pdoVar);
           $execution .= "\$this->".$columna[1]."";
        }
        $preparation .= "       \$this->".$columna[1]." =       htmlentities(addslashes(\$this->".$columna[1]."));\n";
    }
    $query = $pdoVar." where ".$update[1]."=?';\n";
    $preparation .= "\n"; //    ));
    $execution .= ", \$this->".$update[1].")); \n
        \$result ->closeCursor();
            
        // I send success to handle mistakes
        return \$success;
    ";

        $texto .= "
/*!
* \brief    Update all column features by ".$update[1].".
* \details  Using PDO, htmlentities and addslashes, we update the data contained in the instance of the callee class.
* \param \$".$update[1]."    identifier used to find rows to change.
* \\return   \$success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateAllBy".ucfirst($update[1])."(\$".ucfirst($update[1]).") {
        //SQL query for updating
        ".$query.$preparation.$execution."
    }
    \n\n";
    }
}
    
    echo "Update table generados <br>";
    $counter++;
}






function generarReads($columnas,$reads,$tabla) {// localhost
    global $texto;

    global $counter;
    echo $counter.")";

    foreach ($reads as $read) {
        if($read=="all") {
            $selection = "where 1";
            $description = "";
            $param = "";
            $arg="";
            $add = "";
        } else {
            $arg="$".$read;
            $description = "where $read equals the param sent";
            $selection = "where $read=:$read";
            $param = "\n* \param    $read.";
            $add = "
        $".$read."=htmlentities(addslashes($".$read."));
        \$result->BindValue(':".$read."',$".$read.");
            ";
        }

    $foreach="";
    $retuned="";
    foreach ($columnas as $columna) {
        

        if($columna[3]=="rsa") {
            // faltan claves de decript
            $codificacion = "\n                $".$tabla."['".$columna[1]."'] = decrypt_RSA($".$tabla."['".$columna[1]."']);";
        } else {
            $codificacion = "";
        }

        $foreach .= "
                $".$tabla."['".$columna[1]."'] = stripslashes(html_entity_decode($".$tabla."['".$columna[1]."']));".$codificacion." ";
        $retuned.="-".$columna[1];
    }
    $foreach .= "
            }
        }

        return \$row;
    }";
    $foreach = "
        if(!empty(\$row)) {
            foreach(\$row as \$news => &$".$tabla.") {".$foreach;
    $query = "    
    public function read".ucfirst($read)."($arg) {
        \$query='select * from $tabla $selection';
        \$result= \$this->base->prepare(\$query);
        ".$add."
        \$result->execute();
        \$row=\$result->fetchAll(PDO::FETCH_ASSOC);
        \$result ->closeCursor();";

        $texto .= "
/*!
* \brief    Gets all the rows from the database ".$description."
* \details  By sql query using PDO, we get all the results of the database and send them as an array.".$param."
* \\return   \$row  (array) all pairs of $retuned in the database.
*/".$query.$foreach."\n\n";

}

    echo "Reads generada <br>";
    $counter++;
}










function generarDeletes($deletes,$tabla) {// localhost
    global $texto;

    global $counter;
    echo $counter.")";

    foreach($deletes as $delete) {

        if($delete=="all") {
            $arg = "";
            $name = "delete".ucfirst($delete);
            $query = " where 1';";
            $description = "Deletes all rows in the database";
            $bind="";
            $details="\details  By sql query using PDO, we delete all.";
        } else {
            $arg = "$".$delete;
            $name = "deleteBy".ucfirst($delete);
            $query = " where $delete=:$delete';";
            $description = "Deletes rows in the database by $delete";
            $bind="
        $".$delete."=htmlentities(addslashes($".$delete."));
        \$result->BindValue(':".$delete."',$".$delete.");\n";
            $details="\details  By sql query using PDO, we delete all the results where the $delete matches.";
        }

        $texto .= "
/*!
* \brief    ".$description."
* ".$details."
* \param $delete    Identifier of what we want to erase from the database.
* \\return   \$success  (bool) true if it has deleted the row, false in any other case.
*/
    public function $name(".$arg.") {
        \$query='delete from ".$tabla.$query."
        \$result= \$this->base->prepare(\$query);".$bind."
        \$success = \$result->execute();
        \$result ->closeCursor();
        return \$success;
    }
\n\n";
    }

    echo "deletes generada <br>";
    $counter++;
}











// Funciones de librería



?>