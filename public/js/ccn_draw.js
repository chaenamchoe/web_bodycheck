var canvas = new fabric.Canvas('canvas');
canvas.setWidth(600);
canvas.setHeight(800);
var imageUrl = 'http://localhost/bodycheck/public/upload/1/1.jpeg';
fabric.Image.fromURL(imageUrl, function(img) {
    // add background image
    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
       scaleX: canvas.width / img.width,
       scaleY: canvas.height / img.height
    });
 });
/*
  function draw_line(){
    canvas.isDrawingMode = false;  
    // create a rectangle object
    var rect = new fabric.Rect({
        left: 100,
        top: 100,
        fill: 'red',
        width: 20,
        height: 20
    });
    canvas.add(rect);
  };
*/  
function change_color(sval){
    var new_color = new fabric.Color(sval);
    var active = canvas.getActiveObject();
    active.set({
        stroke: new_color,
        strokeWidth: 2,
    });
    canvas.renderAll();
}  
function draw_line(){
    canvas.isDrawingMode = false; 
    var waterLine = new fabric.Line(
        [100, 100, 300, 100],
        {
            stroke: "blue",
            strokeWidth: 2,
            hasControls: true,
            hasBorders: true,
            selectable: true,
            hoverCursor: "pointer",
            originX: "center",
            originY: "center"
        }
    );
    waterLine.set({
        borderColor: 'red',
        cornerColor: 'green',
        cornerSize: 6
      });
    canvas.add(waterLine);
    waterLine.on('rotating', function() {
      console.log('selected a rectangle');
    });
  };
  function draw_text(){
    var t1 = new fabric.Textbox('My Text', {
        width: 100,
        top: 100,
        left: 100,
        fontSize: 20,
        textAlign: 'center'
    });
    canvas.add(t1);
  }
  function draw_free(){
    canvas.isDrawingMode = true;
    canvas.freeDrawingBrush.color = "blue";
    canvas.freeDrawingBrush.width = 2;
    // canvas.set('strokeWidth', 3);
  };
  function clear_canvas(){
    canvas.isDrawingMode = false;  
    var active = canvas.getActiveObject()
    if (active) {
        canvas.remove(active)
        if (active.type == "activeSelection") {
            active.getObjects().forEach(x => canvas.remove(x))
            canvas.discardActiveObject().renderAll()
        }
    }
  };

canvas.renderAll();

