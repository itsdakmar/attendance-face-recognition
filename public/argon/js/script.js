const video = document.getElementById('video')
let newArray = [];

Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri('/argon/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/argon/models'),
    faceapi.nets.faceRecognitionNet.loadFromUri('/argon/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('/argon/models')
]).then(startVideo)

function startVideo() {
    navigator.getUserMedia(
        {video: {}},
        stream => video.srcObject = stream,
        err => console.error(err)
    )
}

video.addEventListener('play', async () => {
    const canvas = faceapi.createCanvasFromMedia(video)
    $('#canvas').append(canvas);
    const displaySize = { width: video.width, height: video.height }
    faceapi.matchDimensions(canvas, displaySize)
    const labeledFaceDescriptors = await getStudent($('#class_id').data('subject')).then((res) =>
        loadLabeledImages(res)
    );
    const faceMatcher = await new faceapi.FaceMatcher(labeledFaceDescriptors, 1)

    setInterval(async () => {
        // FACE REC
        faceapi.matchDimensions(canvas, displaySize)
        const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors()
        const resizedDetections = faceapi.resizeResults(detections, displaySize)
        const results = resizedDetections.map(d => {
            return faceMatcher.findBestMatch(d.descriptor);
        });

        $.each(results, function (el, value) {
            $.ajax({
                method: "POST",
                url: $('#class_id').data('href'),
                data : {
                    'class_id': $('#class_id').val(),
                    'student_id' : value.label
                },
                success: function (data) {
                    var exists = false;
                    $.each(newArray, function(key, value) {
                        if(data === value){
                            exists = true;
                        }
                    });
                    if(exists === false ) {
                        newArray.push(data);
                    }

                    regenerateList(newArray);
                }
            });
        });

        results.forEach((result, i) => {
            const box = resizedDetections[i].detection.box
            const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
            drawBox.draw(canvas)
        })
    }, 1000)

})

function getStudent(url) {
    return fetch(url).then((response) => response.json());
}

function loadLabeledImages(labels) {
    return Promise.all(
        labels.map(async label => {
            const descriptions = []
            const img = await faceapi.fetchImage('http://localhost/student/'+label+'/image')
            const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
            descriptions.push(detections.descriptor)

            return new faceapi.LabeledFaceDescriptors(label, descriptions)
        })
    )
}

function regenerateList(students){
    $('#present').html('');
    $.each(students, function (key, value) {
        $('#present').append('<li class="list-group-item">'+value+'</li>');
    })
}
