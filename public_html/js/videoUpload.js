document.addEventListener('DOMContentLoaded', function () {
    "use strict"; // Start of use strict
    document.getElementsByName('upload')[0].addEventListener('change', function (event) {
        document.getElementById('spinner').classList.remove('d-none');
        var file = event.target.files[0];
        var fileReader = new FileReader();
        fileReader.onload = function () {
            var blob = new Blob([fileReader.result], {type: file.type});
            var url = URL.createObjectURL(blob);
            var video = document.createElement('video');
            var timeupdate = function () {
                if (snapImage()) {
                    video.removeEventListener('timeupdate', timeupdate);
                    video.pause();
                }
            };
            video.addEventListener('loadeddata', function () {
                if (snapImage()) {
                    video.removeEventListener('timeupdate', timeupdate);
                }
            });
            var snapImage = function () {
                var canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                var image = canvas.toDataURL();
                var success = image.length > 150000;
                if (success) {
                    var img = document.createElement('img');
                    img.src = image;
                    img.width = 426;
                    img.height = 240;
                    img.classList.add('rounded');
                    img.classList.add('mx-auto');
                    img.classList.add('d-block');
                    img.classList.add('img-fluid');
                    var thumbnail = document.getElementById('thumbnail');
                    thumbnail.appendChild(img);

                    document.getElementsByName('generated_image')[0].value = image;

                    URL.revokeObjectURL(url);
                    document.getElementById('spinner').classList.add('d-none');
                }
                return success;
            };
            video.addEventListener('timeupdate', timeupdate);
            video.preload = 'metadata';
            video.src = url;
            // Load video in Safari / IE11
            video.muted = true;
            video.playsInline = true;
            video.play();
        };
        fileReader.readAsArrayBuffer(file);
    });

    document.getElementById('submit_upload').addEventListener('click', function(){
        document.getElementById('spinner_upload').classList.remove('d-none');
        this.classList.add('d-none');
    });
}, false);
