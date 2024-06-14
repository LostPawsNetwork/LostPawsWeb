<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $fileTmpPath = $_FILES["file"]["tmp_name"];
        $fileName = $_FILES["file"]["name"];
        $fileSize = $_FILES["file"]["size"];
        $fileType = $_FILES["file"]["type"];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ["jpg", "jpeg", "png"];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = "uploads/";
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $ch = curl_init();
                curl_setopt(
                    $ch,
                    CURLOPT_URL,
                    "http://161.132.47.250:8000/classify/"
                );
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $cfile = new CURLFile($dest_path, $fileType, $fileName);
                $postData = ["file" => $cfile];

                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "accept: application/json",
                    "Content-Type: multipart/form-data",
                ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

                $response = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo "Error:" . curl_error($ch);
                }
                curl_close($ch);

                $resultArray = json_decode($response, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $bestResult = null;
                    foreach ($resultArray as $result) {
                        if (
                            $bestResult === null ||
                            $result["score"] > $bestResult["score"]
                        ) {
                            $bestResult = $result;
                        }
                    }
                    if ($bestResult) {
                        echo "<h2>Resultado de la clasificación:</h2>";
                        echo "<p>La raza más probable es: <strong>" .
                            htmlspecialchars($bestResult["label"]) .
                            "</strong></p>";
                    } else {
                        echo "<p>No se pudo determinar la raza.</p>";
                    }
                } else {
                    echo "<p>Error al procesar la respuesta de la API.</p>";
                }
            } else {
                echo "Error al mover el archivo subido";
            }
        } else {
            echo "Tipo de archivo no permitido. Solo se permiten archivos JPG, JPEG y PNG.";
        }
    } else {
        echo "Error al subir el archivo";
    }
}
?>
