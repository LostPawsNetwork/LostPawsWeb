<?php
session_start();

if (
    !isset($_SESSION["loggedin"]) ||
    $_SESSION["loggedin"] !== true ||
    ($_SESSION["tipoUsuario"] !== "admin" &&
        $_SESSION["tipoUsuario"] !== "superadmin")
) {
    header("Location: /lostpaws/presentacion/login.php");
    exit();
}

ob_start();

$categorias = [
    "chihuahua" => "Chihuahua",
    "japanese_spaniel" => "Spaniel Japonés",
    "maltese_dog" => "Perro Maltés",
    "pekinese" => "Pekines",
    "shih-Tzu" => "Shih Tzu",
    "blenheim_spaniel" => "Spaniel Blenheim",
    "papillon" => "Papillon",
    "toy_terrier" => "Terrier Miniatura",
    "rhodesian_ridgeback" => "Ridgeback Rodesiano",
    "afghan_hound" => "Galgo Afgano",
    "basset" => "Basset",
    "beagle" => "Beagle",
    "bloodhound" => "Bloodhound",
    "bluetick" => "Coonhound Bluetick",
    "black-and-tan_coonhound" => "Coonhound Negro y Fuego",
    "Walker_hound" => "Walker Hound",
    "english_foxhound" => "Foxhound Inglés",
    "redbone" => "Redbone Coonhound",
    "borzoi" => "Borzoi",
    "irish_wolfhound" => "Lobero Irlandés",
    "italian_greyhound" => "Galgo Italiano",
    "whippet" => "Whippet",
    "ibizan_hound" => "Podenco Ibicenco",
    "norwegian_elkhound" => "Elkhound Noruego",
    "otterhound" => "Otterhound",
    "saluki" => "Saluki",
    "scottish_deerhound" => "Lobero Escocés",
    "weimaraner" => "Braco de Weimar",
    "staffordshire_bullterrier" => "Bullterrier de Staffordshire",
    "american_Staffordshire_terrier" => "Terrier Americano de Staffordshire",
    "bedlington_terrier" => "Terrier de Bedlington",
    "border_terrier" => "Terrier de la Frontera",
    "kerry_blue_terrier" => "Terrier Azul de Kerry",
    "irish_terrier" => "Terrier Irlandés",
    "norfolk_terrier" => "Terrier de Norfolk",
    "norwich_terrier" => "Terrier de Norwich",
    "yorkshire_terrier" => "Terrier Yorkshire",
    "wire-haired_fox_terrier" => "Terrier Fox de Pelo Duro",
    "lakeland_terrier" => "Terrier de Lakeland",
    "sealyham_terrier" => "Terrier de Sealyham",
    "airedale" => "Airedale",
    "cairn" => "Cairn Terrier",
    "australian_terrier" => "Terrier Australiano",
    "dandie_Dinmont" => "Dandie Dinmont Terrier",
    "boston_bull" => "Boston Terrier",
    "miniature_schnauzer" => "Schnauzer Miniatura",
    "giant_schnauzer" => "Schnauzer Gigante",
    "standard_schnauzer" => "Schnauzer Estándar",
    "scotch_terrier" => "Terrier Escocés",
    "tibetan_terrier" => "Terrier Tibetano",
    "silky_terrier" => "Terrier Sedoso",
    "soft-coated_wheaten_terrier" => "Terrier de Trigo de Pelo Suave",
    "west_Highland_white_terrier" =>
        "Terrier Blanco de las Tierras Altas del Oeste",
    "lhasa" => "Lhasa Apso",
    "flat-coated_retriever" => "Retriever de Pelo Liso",
    "curly-coated_retriever" => "Retriever de Pelo Rizado",
    "golden_retriever" => "Golden Retriever",
    "labrador_retriever" => "Labrador Retriever",
    "chesapeake_Bay_retriever" => "Retriever de la Bahía de Chesapeake",
    "german_short-haired_pointer" => "Braco Alemán de Pelo Corto",
    "vizsla" => "Vizsla",
    "english_setter" => "Setter Inglés",
    "irish_setter" => "Setter Irlandés",
    "gordon_setter" => "Setter Gordon",
    "brittany_spaniel" => "Spaniel Bretón",
    "clumber" => "Clumber Spaniel",
    "english_springer" => "Springer Spaniel Inglés",
    "welsh_springer_spaniel" => "Springer Spaniel Galés",
    "cocker_spaniel" => "Cocker Spaniel",
    "sussex_spaniel" => "Spaniel de Sussex",
    "irish_water_spaniel" => "Spaniel de Agua Irlandés",
    "kuvasz" => "Kuvasz",
    "schipperke" => "Schipperke",
    "groenendael" => "Groenendael",
    "malinois" => "Malinois",
    "briard" => "Briard",
    "kelpie" => "Kelpie",
    "komondor" => "Komondor",
    "old_English_sheepdog" => "Antiguo Pastor Inglés",
    "shetland_sheepdog" => "Perro Pastor de Shetland",
    "collie" => "Collie",
    "border_collie" => "Collie de la Frontera",
    "bouvier_des_Flandres" => "Bouvier de Flandes",
    "rottweiler" => "Rottweiler",
    "german_shepherd" => "Pastor Alemán",
    "doberman" => "Doberman",
    "miniature_pinscher" => "Pinscher Miniatura",
    "greater_Swiss_Mountain_dog" => "Gran Boyero Suizo",
    "bernese_mountain_dog" => "Boyero de Berna",
    "appenzeller" => "Appenzeller",
    "entleBucher" => "Boyero de Entlebuch",
    "boxer" => "Boxer",
    "bull_mastiff" => "Bullmastiff",
    "tibetan_mastiff" => "Mastín Tibetano",
    "french_bulldog" => "Bulldog Francés",
    "great_Dane" => "Gran Danés",
    "saint_Bernard" => "San Bernardo",
    "eskimo_dog" => "Perro Esquimal",
    "malamute" => "Malamute",
    "siberian_husky" => "Husky Siberiano",
    "affenpinscher" => "Affenpinscher",
    "basenji" => "Basenji",
    "pug" => "Pug",
    "leonberg" => "Leonberger",
    "newfoundland" => "Terranova",
    "great_Pyrenees" => "Gran Pirineo",
    "samoyed" => "Samoyedo",
    "pomeranian" => "Pomerania",
    "chow" => "Chow Chow",
    "keeshond" => "Keeshond",
    "brabancon_griffon" => "Grifón de Bruselas",
    "pembroke" => "Pembroke Welsh Corgi",
    "cardigan" => "Cardigan Welsh Corgi",
    "toy_poodle" => "Poodle Toy",
    "miniature_poodle" => "Poodle Miniatura",
    "standard_poodle" => "Poodle Estándar",
    "mexican_hairless" => "Xoloitzcuintle",
    "dingo" => "Dingo",
    "dhole" => "Dhole",
    "african_hunting_dog" => "Perro de Caza Africano",
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../datos/can.php";

    $nombre = $_POST["nombre"];
    $raza = "";
    $edad = $_POST["edad"];
    $tamano = $_POST["tamano"];
    $genero = $_POST["genero"];
    $observacionesMedicas = $_POST["observacionesMedicas"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];

    // Manejar la subida de la imagen
    $target_dir = "../assets/images/canes/";
    $target_file = $target_dir . basename($_FILES["foto1"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $error = "";

    // Comprobar si el archivo es una imagen real
    $check = getimagesize($_FILES["foto1"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $error = "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Comprobar si el archivo ya existe
    if (file_exists($target_file)) {
        $error = "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Comprobar el tamaño del archivo
    if ($_FILES["foto1"]["size"] > 500000) {
        $error = "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    if (
        $imageFileType != "jpg" &&
        $imageFileType != "png" &&
        $imageFileType != "jpeg" &&
        $imageFileType != "gif"
    ) {
        $error = "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Comprobar si $uploadOk está establecido en 0 por un error
    if ($uploadOk == 0) {
        $error = "Lo siento, tu archivo no fue subido.";
    } else {
        if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $target_file)) {
            $foto1 = $target_file;

            // Llamar a la API para obtener la raza del perro
            $ch = curl_init();
            curl_setopt(
                $ch,
                CURLOPT_URL,
                "http://161.132.47.250:8000/classify/"
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $cfile = new CURLFile($foto1, $imageFileType, basename($foto1));
            $postData = ["file" => $cfile];

            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "accept: application/json",
                "Content-Type: multipart/form-data",
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                $error = "Error:" . curl_error($ch);
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
                    $raza = $categorias[$bestResult["label"]] ?? "Desconocida";
                } else {
                    $raza = "Desconocida";
                }
            } else {
                $error = "Error al procesar la respuesta de la API.";
            }
        } else {
            $error = "Lo siento, hubo un error al subir tu archivo.";
        }
    }
    echo $error;
    if ($uploadOk == 1 && empty($error)) {
        $can = new Can();
        $can->registrarCan(
            $nombre,
            $raza,
            $edad,
            $tamano,
            $genero,
            $observacionesMedicas,
            $descripcion,
            $foto1,
            null,
            null,
            $estado
        );

        header("Location: ../presentacion/dashboard.php");
        exit();
    }
}

ob_end_flush();
?>
