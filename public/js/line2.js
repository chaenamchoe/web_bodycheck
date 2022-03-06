let canvas = new fabric.Canvas('canvas');
canvas.setWidth(600);
canvas.setHeight(800);

let imageUrl = 'http://localhost/bodycheck/public/upload/1/1.jpeg';
fabric.Image.fromURL(imageUrl, function(img) {
    // add background image
    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
       scaleX: canvas.width / img.width,
       scaleY: canvas.height / img.height
    });
 });

let line;
let mouseDown = false;
let addingLineBtnClicked = false;
 
let addingLineBtn = document.getElementById('lineBtn');
addingLineBtn.addEventListener('click', activateAddingLine);

function activateAddingLine(){
    if(addingLineBtnClicked===false){
        canvas.isDrawingMode = false;  
        addingLineBtnClicked = true;
        canvas.on('mouse:down', startAddingLine);
        canvas.on('mouse:move', startDrawingLine);
        canvas.on('mouse:up', stopDrawingLine);
        
        canvas.selection = false;
        canvas.hoverCursor = 'auto';

        objectSelectablelity('line', false);
    }
} 

function startAddingLine(o){
    mouseDown = true;
    let pointer = canvas.getPointer(o.e);

    line = new fabric.Line([pointer.x, pointer.y, pointer.x, pointer.y],{
        id: 'line',
        stroke: 'red',
        strokeWidth: 3,
        selectable: false,
        hasControls: true
    });
    canvas.add(line);
    canvas.requestRenderAll();
}
function startDrawingLine(o){
    if(mouseDown===true){
        addingLineBtnClicked = false;
        let pointer = canvas.getPointer(o.e);
        line.set({
            x2: pointer.x,
            y2: pointer.y
        });
        canvas.requestRenderAll();
    }
}
function stopDrawingLine(){
    addingLineBtnClicked = false;
    mouseDown = false;
    line.setCoords();
}

let deactivateAddingShapeBtn = document.getElementById('selectBtn');
deactivateAddingShapeBtn.addEventListener('click', deactivateAddingShape);
function deactivateAddingShape(){
    canvas.off('mouse:down', startAddingLine);
    canvas.off('mouse:move', startDrawingLine);
    canvas.off('mouse:up', stopDrawingLine);

    objectSelectablelity('line', true);

    canvas.hoverCursor = 'all-scroll';
    addingLineBtnClicked = false;
}

function objectSelectablelity(id, value){
    canvas.getObjects().forEach(o => {
        if(o.id===id){
            o.set({
                selectable : value
            });
        }
    });
}

function change_color(color){
    var active = canvas.getActiveObject();
    active.set({
        stroke: '#' + color,
        strokeWidth: 2,
    });
    canvas.renderAll();
}  
function clear_all(){
    canvas.isDrawingMode = false;  
    canvas.getObjects().forEach((o) => {
        if(o !==canvas.backgroundImage){
            canvas.remove(o);
        }
    });
};

function clear_select(){
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
  function draw_text(){
    addingLineBtnClicked = false;  
    canvas.isDrawingMode = false;  
    var t1 = new fabric.Textbox('My Text', {
        width: 100,
        top: 100,
        left: 100,
        fontSize: 20,
        stroke: 'red',
        fill: 'red',
        textAlign: 'center'
    });
    canvas.add(t1);
  }
  function draw_free(){
    stopDrawingLine();  
    addingLineBtnClicked = true;  
    canvas.isDrawingMode = true;
    canvas.freeDrawingBrush.color = "blue";
    canvas.freeDrawingBrush.width = 2;
    // canvas.set('strokeWidth', 3);
  };
