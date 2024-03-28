<?php
/*functions
createDirectory($directoryName)
deleteDirectory($directory)
createFileInDirectory($directory, $fileName)
writeToFile($text, $fileName)
moveDirectory($source, $destination)
rmdirRecursive($directory)
*/
include_once "./stdio.php";
$texto = "";

crearSQL($columnasSQL,$nombreDeLaTabla);
writeToFile($texto, "api/v1/".$nombreDeLaTabla.".sql");

echo "<br><br><a href='indexCreator.php'>Go to index creator</a>";

// Ejemplo de uso
function crearSQL($columnas, $tabla) {
    global $texto;

    $texto = "CREATE TABLE ".$tabla." (";
    $primaryKeys = [];
    foreach($columnas as $columna) {
        agregarCampo($columna[0], $columna[1], $columna[2], $columna[3], $columna[4], $columna[5], $columna[6], $columna[7]);
    }
    $texto = rtrim($texto, ", "); // Eliminar la última coma y espacio

    if (!empty($primaryKeys)) {
        $texto .= ", PRIMARY KEY (`" . implode("`, `", $primaryKeys) . "`)";
    }

    $texto .= ")";

    echo $texto;
}


/**
 * Agrega un campo a una tabla.
 *
 * @param string $nombre El nombre del campo. Debe ser una cadena de texto válida.
 * @param string $tipo El tipo de datos del campo. Puede ser "INT", "VARCHAR", "TEXT", "DATETIME" u otros tipos de datos compatibles.
 * @param int|null $longitud (opcional) La longitud máxima del campo. Válido solo para ciertos tipos de datos, como "VARCHAR". Debe ser un número entero positivo.
 * @param mixed|null $predeterminado (opcional) El valor predeterminado del campo. El valor depende del tipo de campo:
 *     - Para campos de tipo cadena de texto (VARCHAR, TEXT, etc.):
 *         - `$predeterminado = "Texto predeterminado"`
 *         - `$predeterminado = ""` (cadena de texto vacía)
 *     - Para campos de tipo entero (INT, etc.):
 *         - `$predeterminado = 0`
 *         - `$predeterminado = 10`
 *     - Para campos de tipo booleano:
 *         - `$predeterminado = true`
 *         - `$predeterminado = false`
 *     - Para campos de tipo fecha y hora (DATETIME, etc.):
 *         - `$predeterminado = "2024-03-18 12:00:00"`
 *     - Para campos de tipo flotante (FLOAT, etc.):
 *         - `$predeterminado = 3.14`
 *         - `$predeterminado = 0.0`
 *     - Para campos de tipo enumerado (ENUM, etc.):
 *         - `$predeterminado = "opcion1"`
 *         - `$predeterminado = "opcion2"`
 * @param bool $nulo (opcional) Indica si el campo permite valores nulos. Por defecto, se establece en `true`.
 * @param bool $autoincremental (opcional) Indica si el campo es autoincremental. Por defecto, se establece en `false`.
 * @param string|null $descripcion (opcional) Una descripción textual del campo.
 * @param bool $primary (opcional) Indica si el campo es clave primaria. Por defecto, se establece en `false`.
 *
 * @return void
 */
function agregarCampo($nombre, $tipo, $longitud = null, $predeterminado = null, $nulo = true, $autoincremental = false, $descripcion = null, $primary = false) {
    $campo = "`$nombre` $tipo";

    if ($longitud !== null) {
        $campo .= "($longitud)";
    }

    if ($nulo) {
        $campo .= " NULL";
    } else {
        $campo .= " NOT NULL";
    }

    if ($autoincremental) {
        $campo .= " AUTO_INCREMENT";
    }

    if ($predeterminado !== null) {
        $campo .= " DEFAULT '$predeterminado'";
    }

    global $texto;
    $texto .= $campo;

    if ($descripcion !== null) {
        $texto .= " COMMENT '$descripcion'";
    }

    $texto .= ", ";

    if ($primary) {
        global $primaryKeys;
        $primaryKeys[] = $nombre;
    }
}


?>