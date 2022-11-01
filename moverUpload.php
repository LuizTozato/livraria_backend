<?php
    require_once(__DIR__."./utils.php");
    
    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

    $fileNameFull = $_FILES['meu_arquivo']['name'];
    $fileSize = $_FILES['meu_arquivo']['size'];
    $fileTmpName  = $_FILES['meu_arquivo']['tmp_name'];
    $fileType = $_FILES['meu_arquivo']['type'];

    $explodedString = explode('.',$fileNameFull);
    $fileName = strtolower(current($explodedString));
    $fileExtension = strtolower(end($explodedString));

    $pseudoName = uniqid() . "." . $fileExtension;
    $GLOBALS["pseudoName"] = $pseudoName;
    $uploadPath = $currentDirectory . $uploadDirectory . $pseudoName; 

    //Se deu certo, retorna true. Senão, retorna false.
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    if($didUpload){
        echo("Concluido upload");
    } else {
        echo("Upload deu problema...");
    }

    // if (isset($_POST['submit'])) {

    //   if (! in_array($fileExtension,$fileExtensionsAllowed)) {
    //     $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    //   }

    //   if ($fileSize > 4000000) {
    //     $errors[] = "File exceeds maximum size (4MB)";
    //   }

    //   if (empty($errors)) {
    //     $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    //     if ($didUpload) {
    //       echo "The file " . basename($fileName) . " has been uploaded";
    //     } else {
    //       echo "An error occurred. Please contact the administrator.";
    //     }
    //   } else {
    //     foreach ($errors as $error) {
    //       echo $error . "These are the errors" . "\n";
    //     }
    //   }

    // }
?>