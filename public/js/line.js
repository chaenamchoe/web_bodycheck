let canvas = new fabric.Canvas('canvas', {
	width: 600, //window.innerWidth,
	height: 800 //window.innerHeight
});

let line;
let mouseDown = false;
let addingLineBtnClicked = false;
 
let addingLineBtn = document.getElementById('lineBtn');
addingLineBtn.addEventListener('click', activateAddingLine);

function activateAddingLine(){
    if(addingLineBtnClicked===false){
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
        selectable: true,
        hasControls: true
    });
    canvas.add(line);
    canvas.requestRenderAll();
}
function startDrawingLine(o){
    if(mouseDown===true){
        let pointer = canvas.getPointer(o.e);
        line.set({
            x2: pointer.x,
            y2: pointer.y
        });
        canvas.requestRenderAll();
    }
}
function stopDrawingLine(){
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

let newLineCoords = {};
canvas.on({
    'object:moved': updateNewLineCoordinates,
    'selection:created': updateNewLineCoordinates,
    'selection:updated': updateNewLineCoordinates,
    'mouse:dblclick': addingControlPoints
});

function updateNewLineCoordinates(o){
    newLineCoords = {};
    let obj = o.target;
    console.log(obj);
    if(obj.id==='line'){
        let centerX = obj.getCenterPoint().x;
        let centerY = obj.getCenterPoint().y;

        let x1offset = obj.calcLinePoints().x1;
        let y1offset = obj.calcLinePoints().y1;
        let x2offset = obj.calcLinePoints().x2;
        let y2offset = obj.calcLinePoints().y2;

        newLineCoords = {
            x1: centerX + x1offset - obj.strokeWidth/2,
            y1: centerY + y1offset - obj.strokeWidth/2,
            x2: centerX + x2offset - obj.strokeWidth/2,
            y2: centerY + y2offset - obj.strokeWidth/2
        };
        obj.set({
            x1: centerX + x1offset - obj.strokeWidth/2,
            y1: centerY + y1offset - obj.strokeWidth/2,
            x2: centerX + x2offset - obj.strokeWidth/2,
            y2: centerY + y2offset - obj.strokeWidth/2
        });
        obj.setCoords();
    }
}
function addingControlPoints(o){
    let obj = o.target;
    if(!obj){
        return;
    }else{
        if(obj.id==='line'){
            let pointer1 = new fabric.Circle({
                id: 'pointer1',
                radius: obj.strokeWidth * 3,
                fill: 'blue',
                opacity: 0.5,
                top: newLineCoords.y1,
                left: newLineCoords.x1,
                originX: 'center',
                originY: 'center',
                hasBorders: false,
                hasControls: false
            });
            let pointer2 = new fabric.Circle({
                id: 'pointer2',
                radius: obj.strokeWidth * 3,
                fill: 'blue',
                opacity: 0.5,
                top: newLineCoords.y2,
                left: newLineCoords.x2,
                originX: 'center',
                originY: 'center',
                hasBorders: false,
                hasControls: false
            });
            canvas.add(pointer1, pointer2);
            canvas.setActiveObject(pointer1);
            canvas.requestRenderAll();

            canvas.on({
                'object:moving': endPointOfLineToFollowPointer,
                'selection:cleared': removePointers
            });
        }
    }
}
function removePointers(){
    canvas.getObjects().forEach(o => {
        if(o.id==='pointer1' || o.id==='pointer2'){
            canvas.remove(o);
        }
    });
    canvas.requestRenderAll();
}
function endPointOfLineToFollowPointer(o){
    let obj = o.target;
    if(obj.id==='pointer1'){
        canvas.getObjects().forEach(o =>{
            if(o.id==='line'){
                o.set({
                    x1: obj.left,
                    y1: obj.top
                });
                o.setCoords();
            }
        });
    }else if(obj.id==='pointer2'){
        canvas.getObjects().forEach(o =>{
            if(o.id==='line'){
                o.set({
                    x2: obj.left,
                    y2: obj.top
                });
                o.setCoords();
            }
        });
    }
}