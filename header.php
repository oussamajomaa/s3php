<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./Webcam.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>WEB CAM</title>
</head>

<body>
    <div class="jumbotron p-5">
        <div class="row mb-2">
            <div class="col-md-6">
                <video id="webcam" class="mb-2" autoplay playsinline height="480" width="636" style="border: 5px solid;border-radius:5px; display:block;margin:auto;"></video>
                <audio id="snapSound" src="snap.wav" preload="auto"></audio>
                <div class="d-flex justify-content-center ">
                    <button class="btn btn-primary w-50" id="startCamera" onclick="start()">Démarrer la caméra</button>
                    <button class="btn btn-danger w-50" id="stopCamera" onclick="end()">Arrêter la caméra</button>
                </div>
            </div>


            <div class="col-md-6">
                <div>
                    <input type="text" placeholder="VOTRE ID..." id="inputId" class="mb-2 p-1" style="border-radius:5px;width: 640px;">
                </div>
                <canvas id="canvas" class="" style="height:436px; width: 640px; border-radius:5px; border:5px solid;"></canvas>
                <div class="d-flex justify-content-around" style="width: 640px;">
                    <button class="btn btn-primary" style="width: 300px;" id="takeImage" onclick="take()">Prendre une photo</button>
                    <button style="width: 300px;" class="btn btn-success" id="saveImage" data-toggle="modal" data-target="#exampleModalCenter">Sauvgarder</button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-body">
                                    Êtes-vous sûr de sauvgarder la photo?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
                                    <button class="btn btn-success" data-dismiss="modal" onclick="downloadImage()">Oui</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr style="border:10px;">
        <div class="row">
            <div class="col">
                <p class="p border" id="p1" style="height: 150px">
                   <?= $_SESSION["key"] ?>
                </p>
            </div>
            <div class="col">
                <p class="p border" id="p2" style="height: 150px"></p>
            </div>

            <div class="col">
                <p class="p border" id="p3" style="height: 150px"></p>
            </div>
            <div class="col">
                <p class="p border" id="p4" style="height: 150px"></p>
            </div>

            <div class="col">
                <p class="p border" id="p5" style="height: 150px"></p>
            </div>
            <div class="col">
                <p class="p border" id="p6" style="height: 150px"></p>
            </div>
        </div>
    </div>

    <script src="./index.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>