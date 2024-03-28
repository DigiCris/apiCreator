<?php

/*functions
createDirectory($directoryName)
deleteDirectory($directory)
createFileInDirectory($directory, $fileName)
writeToFile($text, $fileName)
moveDirectory($source, $destination)
rmdirRecursive($directory)
*/
include_once "configvars.php";

$counter=1; // Un contador que va poniendome en orden las cosas que voy haciendo con este script

function createDirectory($directoryName) {
    // Verificar si el directorio ya existe
    global $counter;
    echo "".$counter.")";
    if (file_exists($directoryName)) {
        echo " El directorio '$directoryName' ya existía así que lo eliminamos. ";
        deleteDirectory($directoryName);
    }

    // Crear el directorio
    if (mkdir($directoryName, 0777, true)) {
        echo " Se ha creado el directorio '$directoryName' correctamente.";
    } else {
        echo " No se pudo crear el directorio '$directoryName'.";
    }
    echo "<br>";
    $counter++;
}

function deleteDirectory($directory) {
    if (!file_exists($directory)) {
        return;
    }

    $files = array_diff(scandir($directory), array('.', '..'));

    foreach ($files as $file) {
        $path = $directory . '/' . $file;

        if (is_dir($path)) {
            deleteDirectory($path);
        } else {
            unlink($path);
        }
    }

    rmdir($directory);
}

function createFileInDirectory($directory, $fileName) {
    global $counter;
    // Verificar si el directorio existe
    echo "".$counter.")";
    $counter++;
    if (!file_exists($directory)) {
        echo "El directorio '$directory' no existe.";
        return;
    }

    // Crear la ruta completa del archivo
    $filePath = $directory . '/' . $fileName;

    // Crear el archivo
    if (file_put_contents($filePath, '') !== false) {
        echo " Se ha creado el archivo '$fileName' en el directorio '$directory' correctamente.";
    } else {
        echo " No se pudo crear el archivo '$fileName' en el directorio '$directory'.";
    }
    echo "<br>";
}


function writeToFile($text, $fileName) {
    global $counter;
    echo "".$counter.")";
    $counter++;
    // Verificar si el archivo existe
    if (file_exists($fileName)) {
        // Verificar si el archivo es escribible
        if (!is_writable($fileName)) {
            echo " El archivo '$fileName' no es escribible.";
            return;
        }
    }

    // Escribir el texto en el archivo
    if (file_put_contents($fileName, $text) !== false) {
        echo " El archivo '$fileName' se ha escrito correctamente.";
    } else {
        echo " No se pudo escribir en el archivo '$fileName'.";
    }
    echo "<br>";
}




function moveDirectory($source, $destination) {

    global $counter;
    echo "".$counter.")";
    $counter++;

    // Copiar el directorio y su contenido
    if (!is_dir($source)) {
        echo 'ERROR -> al mover y copiar el directorio.';
        echo "<br>";
        return false;
    }

    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }

    $directory = dir($source);
    while (false !== ($entry = $directory->read())) {
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        $entrySource = $source . '/' . $entry;
        $entryDestination = $destination . '/' . $entry;

        if (is_dir($entrySource)) {
            moveDirectory($entrySource, $entryDestination);
        } else {
            copy($entrySource, $entryDestination);
        }
    }

    $directory->close();

    // Borrar el directorio original
    if (is_dir($source)) {
        rmdirRecursive($source);
    }

    echo 'Directorio movido y copiado exitosamente. Desde '.$source." hacia ".$destination;
    echo "<br>";
    return true;
}







function rmdirRecursive($directory) {
    if (!is_dir($directory)) {
        return;
    }

    $files = array_diff(scandir($directory), array('.', '..'));
    foreach ($files as $file) {
        $filePath = $directory . '/' . $file;
        if (is_dir($filePath)) {
            rmdirRecursive($filePath);
        } else {
            unlink($filePath);
        }
    }
    rmdir($directory);
}









?>