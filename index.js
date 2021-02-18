const webcamElement = document.getElementById('webcam');
const canvasElement = document.getElementById('canvas');
const snapSoundElement = document.getElementById('snapSound');
const takeImage = document.getElementById('takeImage');
const startCamera = document.getElementById('startCamera');
const stopCamera = document.getElementById('stopCamera');
const saveImage = document.getElementById('saveImage');
const inputId = document.getElementById('inputId');



const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);

stopCamera.style.display = 'none'
saveImage.disabled = true
takeImage.disabled = true


// démrrer la caméra
function start() {
    webcam.start()
        .then(result => {
            console.log("webcam started");
        })
        .catch(err => {
            console.log(err);
        });
    stopCamera.style.display = 'block'
    startCamera.style.display = 'none'
    takeImage.disabled = false
}

// arrêter la caméra
function end() {
    takeImage.disabled = true
    saveImage.disabled = true
    stopCamera.style.display = 'none'
    startCamera.style.display = 'block'
    takeImage.textContent = 'Prendre une photo'
    let img = document.getElementById('canvaImage')
    var context = canvasElement.getContext('2d');
    context.clearRect(0, 0, canvasElement.width, canvasElement.height);
    console.log(img)
    // document.querySelectorAll('.p').forEach(element => {
    //     element.remove()
    // })
    index = 1
    inputId.value = ""
    webcam.stop()
}


let base64 = ''
// prendre une photo
function take() {
    if (index < 7) {
        base64 = webcam.snap()
        let img = document.createElement('img')
        img.setAttribute('src', base64)
        img.setAttribute('id', 'canvasImage')
        canvasElement.appendChild(img)
        saveImage.disabled = false
        takeImage.textContent = 'Modifier la photo'
    }
}

// convertir en blob
function dataURItoBlob() {
    var binary = atob(base64.split(',')[1]);
    var array = [];
    for (var i = 0; i < binary.length; i++) {
        array.push(binary.charCodeAt(i));
    }
    return new Blob([new Uint8Array(array)], { type: 'image/jpeg' });
}

let index = 1
// sauvegarder la photo
function downloadImage() {
    console.log("gdsgfdgfdgf");
    if (inputId.value !== "") {
        if (index < 7) {
            let fileName = inputId.value + '.jpeg'
            index += 1
            takeImage.textContent = 'Prendre une photo'
            saveImage.disabled = true


            const formData = new FormData()
            let blob = dataURItoBlob(base64)
            formData.set("file", blob, fileName);

            const request = new XMLHttpRequest();
            request.open("post", "http://localhost/TEREGA/s3php/upload.php");
            request.send(formData);

        }
    }
}