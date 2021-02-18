<?php
require 'vendor/autoload.php';

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

require 'config.php';
// récupérer les images depuis S3


//Instantiate an Amazon S3 client.
$s3 = new S3Client($s3config);


// try {
//     // Get the object.
//     $result = $s3->getObject([
//         'Bucket' => $bucket,
//         'Key'    => 'home_2659fd87bc92690dbbef04a93a60e6dd.jpeg'
//     ]);

//     // Display the object in the browser.
//     header("Content-Type: {$result['ContentType']}");
//     echo $result['Body'];
// } catch (S3Exception $e) {
//     echo $e->getMessage() . PHP_EOL;
// }


// obtenire une liste des buckets
// $result = $s3->listBuckets();

// foreach ($result['Buckets'] as $bucket) {
//     // Each Bucket value will contain a Name and CreationDate
//     echo "{$bucket['Name']} - {$bucket['CreationDate']}\n";
// }


// obtenir une liste des objets dans un bucket 
$iterator = $s3->getIterator('ListObjects', [
    'Bucket' => $bucket
    ]);



// récupérer un objet
foreach ($iterator as $keys){
    // var_dump($keys ["Key"]);
    //     echo "<br>";
    // foreach ($keys as $key){
    //     var_dump($key);
    //     echo "<br>";

    $key = $keys["Key"];
        $result = $s3->getObject([
                    'Bucket' => $bucket,
                    'Key'    => $key
                ]);
                header("Content-Type: {$result['ContentType']}");
                
                echo $result['Body'];
                var_dump($result);
    // }
    // foreach ($keys as $key)
    // var_dump($key);
    echo '<br> new line <br>';
// $result = $s3->getObject([
//     'Bucket' => $bucket,
//     'Key'    => $key
// ]);
// header("Content-Type: {$result['ContentType']}");

// echo $result['Body'];
}
