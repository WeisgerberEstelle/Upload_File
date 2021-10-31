<?php
if($_SERVER["REQUEST_METHOD"] === "POST" ){ 

    $uploadDir = 'public/uploads/';

    $uploadFile = $uploadDir . uniqid(). basename($_FILES['homerPicture']['name']);

    $extension = pathinfo($_FILES['homerPicture']['name'], PATHINFO_EXTENSION);

    $extensions_ok = ['jpg','webp','png'];

    $maxFileSize = 131072;

    $user=array_map('trim', $_POST);

    $errors=[];

    if( (!in_array($extension, $extensions_ok ))){

        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Webp ou Png !';

    }

    if( file_exists($_FILES['homerPicture']['tmp_name']) && filesize($_FILES['homerPicture']['tmp_name']) > $maxFileSize)

    {

    $errors[] = "Votre fichier doit faire moins de 1M !";

    }

    if(empty($user['name'])) {
            $errors[] = 'le nom est obligatoire';
    }

    if(empty($user['firstname'])) {
        $errors[] = 'le prénom est obligatoire';
    }

    if(empty($user['age'])) {
        $errors[] = 'l\'age est obligatoire';
    }

    if(empty($errors)) {

        if (move_uploaded_file($_FILES['homerPicture']['tmp_name'], $uploadFile)) {
            echo '<img src="'.$uploadFile.'" alt="Homer"> <br>';
            echo  $user['name'] . ' ' . $user['firstname'] . ' ' . $user['age'] . " ans";
        };

    } else {
        echo implode('<br>',$errors);
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<form method="post" enctype="multipart/form-data">

    <label for="imageUpload">Upload an profile image</label>  
    <input type="file" name="homerPicture" id="imageUpload" />

    <label for = "name">Nom</label>
    <input type ="text" name="name" id="name">

    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname">

    <label for="age">Age</label>
    <input type="number" name="age" id="age">


    <button name="send">Send</button>

</form>