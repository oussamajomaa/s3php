<?php
session_start();
require 'vendor/autoload.php';

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

require 'config.php';



//Instantiate an Amazon S3 client.
$s3 = new S3Client($s3config);

// // récupérer le nom du fichier et son extention
$file = $_FILES["file"];
$name = $file['name'];
$extention = explode('.',$name);
$id = $extention[0];
$extention = end($extention);

// // générer un unique id
$uniqid = md5(uniqid());

// concatener le l'id du prestataire avec l'id unique et l'extention du fichier
$key = $id.'_'.$uniqid.'.'.$extention;

// récupérer le nom temporaire du fichier
$tmp_name = $file['tmp_name'];

// stocker le path avec le nom du fichier dans une variable
$Path = __DIR__ . "/files/$name";

// téléverser le fichier ( l'image prise par la caméra dans le dossier "files")
move_uploaded_file($tmp_name, $Path);





// transformer le fichier vers S3 aws
try {
    $result = $s3->putObject([
        'Bucket' => $bucket,
        'Key'    => $key,
        'Body'   => fopen($Path, 'r'),
        'ACL'    => 'public-read',
    ]);
    echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
} catch (S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

// supprimer le fichier du dossier "files"
unlink(__DIR__ . "/files/$name");

$_SESSION["image"]=$key;

?>

