/**
 * Created by Aminidir on 13/06/15.
 */

var videoId = 'video';
var scaleFactor = 0.25;
var snapshots = [];

/**
 * Captures a image frame from the provided video element.
 *
 * @param {Video} video HTML5 video element from where the image frame will be captured.
 * @param {Number} scaleFactor Factor to scale the canvas element that will be return. This is an optional parameter.
 *
 * @return {Canvas}
 */
function capture(video, scaleFactor,index) {
    if(scaleFactor == null){
        scaleFactor = 1;
    }
    var w = 525;//video.videoWidth * scaleFactor;
    var h = 300;//video.videoHeight * scaleFactor;
    if(index>1 && index <=4){
        w= 350;
        h= 200;
    }
    else if(index>4){
        w= 200;
        h= 120;
    }
    var canvas = document.createElement('canvas');
    canvas.width  = w;
    canvas.height = h;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, w, h);
    return canvas;
}

/**
 * Invokes the <code>capture</code> function and attaches the canvas element to the DOM.
 */
function shoot(output){

    var allPicId = ["big-pic", "big-pic2", "big-pic3","big-pic4","big-pic5","big-pic6","big-pic7","big-pic8","big-pic9","big-pic10","big-pic11"];
    var allVidId =  ["video1", "video2", "video3","video4","video5","video6","video7","video8","video9","video10","video11"];

    allPicId.forEach(function(element,index){

        //window.alert(element + " index: " +  index );
        var video  = document.getElementById(allVidId[index]);
        var output = document.getElementById(element);

        var canvas = capture(video, scaleFactor,index);
        //            canvas.onclick = function(){
        //                window.open(this.toDataURL());
        //            };
        snapshots.unshift(canvas);
        output.innerHTML = '';

        // for(var i=0; i<snapshots.length; i++){
        //output.getAttribute('src').value = snapshots[i].toDataURL("image/png");
        output.appendChild(snapshots[0]);
        //}

    });
}
