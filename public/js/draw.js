const canvas = document.getElementById("canvas");
canvas.width = 600;
canvas.height = 800;

let context = canvas.getContext("2d");
let start_background_color = "white";
context.fillStyle = start_background_color;
context.fillRect(0,0,canvas.width, canvas.height);

let draw_color = "black";
let draw_width = "2";
let is_drawing = false;

let restore_array = [];
let index = -1;

let img = new Image();
img.onload = function(){
  context.drawImage(img, 0,0,img.width, img.height, 0, 0, canvas.width, canvas.height);
}
// 이미지 URL
img.src = 'http://localhost/bodycheck/public/images/1.jpeg';

function change_color(element){
    draw_color = element.style.background;
}

canvas.addEventListener("touchstart", start, false);
canvas.addEventListener("touchmove", draw, false);
canvas.addEventListener("mousedown", start, false);
canvas.addEventListener("mousemove", draw, false);

canvas.addEventListener("touchend", stop, false);
canvas.addEventListener("mouseup", stop, false);
canvas.addEventListener("mouseout", stop, false);

function start(event){
    is_drawing = true;
    context.beginPath();
    context.moveTo(event.clientX - canvas.offsetLeft,
                   event.clientY - canvas.offsetTop);
    event.preventDefault();               
}
function draw(event){
    if(is_drawing){
        context.lineTo(event.clientX - canvas.offsetLeft,
                       event.clientY - canvas.offsetTop);
        context.strokeStyle = draw_color;
        context.lineWidth = draw_width;
        context.lineCap = "round";
        context.lineJoin = "round";
        context.stroke();               
    }
    event.preventDefault(); 
}
function stop(event){
    if(is_drawing){
        context.stroke();
        context.closePath();
        is_drawing = false;
    }
    event.preventDefault(); 
    if(event.type != "mouseout"){
        restore_array.push(context.getImageData(0,0,canvas.width, canvas.height));
        index += 1;
    }
}
function clear_canvas(){
    context.fillStyle = start_background_color;
    context.clearRect(0, 0, canvas.width, canvas.height);
    context.fillRect(0, 0, canvas.width, canvas.height);

    restore_array = [];
    index = -1;
}
function undo_last(){
    if(index <= 0){
        clear_canvas();
    }else{
        index -= 1;
        restore_array.pop();
        context.putImageData(restore_array[index], 0, 0);
    }
}
function draw_line(){
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");
    var canvasOffset = $("#canvas").offset();
    var offsetX = canvasOffset.left;
    var offsetY = canvasOffset.top;
    var storedLines = [];
    var startX = 0;
    var startY = 0;
    var isDown;

    context.strokeStyle = draw_color;
    context.lineWidth = draw_width;
    canvas.addEventListener("mousedown", handleMouseDown, false);
    canvas.addEventListener("mousemove", handleMouseMove, false);
    canvas.addEventListener("mouseup", handleMouseUp, false);
    $("#clear").click(function() {
        storedLines.length = 0;
        redrawStoredLines();
    });

    function handleMouseDown(e) {
        var mouseX = parseInt(e.clientX - offsetX);
        var mouseY = parseInt(e.clientY - offsetY);
        isDown = true;
        startX = mouseX;
        startY = mouseY;
    }

    function handleMouseMove(e) {
        if (!isDown) {
            return;
        }
        context.drawImage(img, 0,0,img.width, img.height, 0, 0, canvas.width, canvas.height);
        redrawStoredLines();
        var mouseX = parseInt(e.clientX - offsetX);
        var mouseY = parseInt(e.clientY - offsetY);
        // draw the current line
        context.beginPath();
        context.moveTo(startX, startY);
        context.lineTo(mouseX, mouseY);
        context.stroke();
    }


    function handleMouseUp(e) {
        isDown = false;
        var mouseX = parseInt(e.clientX - offsetX);
        var mouseY = parseInt(e.clientY - offsetY);
        storedLines.push({
            x1: startX,
            y1: startY,
            x2: mouseX,
            y2: mouseY
        });
        redrawStoredLines();
    }

    function redrawStoredLines() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        if (storedLines.length == 0) {
            return;
        }
        // redraw each stored line
        context.drawImage(img, 0,0,img.width, img.height, 0, 0, canvas.width, canvas.height);
        for (var i = 0; i < storedLines.length; i++) {
            context.beginPath();
            context.moveTo(storedLines[i].x1, storedLines[i].y1);
            context.lineTo(storedLines[i].x2, storedLines[i].y2);
            context.stroke();
        }
    }
}