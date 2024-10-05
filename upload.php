<?php
// Ruta de la carpeta donde se guardarán las imágenes subidas
$targetDir = "fotosaqui/";

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);  // Crea la carpeta si no existe
}

if (!empty($_FILES['files']['name'][0])) {
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $fileName = basename($_FILES['files']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;
        
        // Comprueba si el archivo es una imagen
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Sube el archivo al servidor
            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                echo "El archivo " . $fileName . " ha sido subido correctamente.<br>";
            } else {
                echo "Hubo un error al subir el archivo " . $fileName . ".<br>";
            }
        } else {
            echo "El archivo " . $fileName . " no es un tipo permitido.<br>";
        }
    }
} else {
    echo "Por favor selecciona al menos un archivo.";
}

// Redirigir de vuelta a index.html
header("Location: index.html");
?>
