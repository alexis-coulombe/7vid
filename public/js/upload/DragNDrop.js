$(function () {
    let dropZoneId = "drop-zone";
    let buttonId = "clickHere";
    let mouseOverClass = "mouse-over";

    let dropZone = $("#" + dropZoneId);
    let ooleft = dropZone.offset().left;
    let ooright = dropZone.outerWidth() + ooleft;
    let ootop = dropZone.offset().top;
    let oobottom = dropZone.outerHeight() + ootop;
    let inputFile = dropZone.find("input");

    document.getElementById(dropZoneId).addEventListener("dragover", function (e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.addClass(mouseOverClass);
        let x = e.pageX;
        let y = e.pageY;

        if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
            inputFile.offset({ top: y - 15, left: x - 100 });
        } else {
            inputFile.offset({ top: -400, left: -400 });
        }

    }, true);

    if (buttonId != "") {
        let clickZone = $("#" + buttonId);

        let oleft = clickZone.offset().left;
        let oright = clickZone.outerWidth() + oleft;
        let otop = clickZone.offset().top;
        let obottom = clickZone.outerHeight() + otop;

        $("#" + buttonId).mousemove(function (e) {
            let x = e.pageX;
            let y = e.pageY;
            if (!(x < oleft || x > oright || y < otop || y > obottom)) {
                inputFile.offset({ top: y - 15, left: x - 160 });
            } else {
                inputFile.offset({ top: -400, left: -400 });
            }
        });
    }

    document.getElementById(dropZoneId).addEventListener("drop", function (e) {
        $("#" + dropZoneId).removeClass(mouseOverClass);
    }, true);
});

$('#file').change(
    function(e){
        let fname = e.target.files[0].name;
        let fsize = e.target.files[0].size;
        $('#drop-zone-text').text(fname + ' (' + bytesToSize(fsize) + ')');
        $('#video-title').val(fname);
    });

function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
};