let canvas = new fabric.Canvas('canvas',{
    width: window.innerWidth,
    height: window.innerHeight,
});
let imageUrl = 'http://localhost/bodycheck/public/upload/1/1.jpeg';
fabric.Image.fromURL(imageUrl, function(img) {
    // add background image
    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
        scaleX: (canvas.width / 2) / img.width,
        scaleY: canvas.height / img.height
     });
});

let $ = function(el){
    return document.getElementById(el);
}
let shapeBtns = [$('line-btn'), $('single-arrow-head-line-btn'), $('double-arrow-head-line-btn')];
let numberOfBtns = shapeBtns.length;
let btnIndex = 0;
for(let i=0; i<numberOfBtns; i++){
    shapeBtns[i].addEventListener('click', ()=>{
        deactivateMouseEvents();
        canvas.getObjects().forEach(o => {
            o.selectable = false;
        });
        $('deactivate-adding-shape-btn').style.display = 'block';
        canvas.selection = false;
        canvas.on({
            'mouse:down': addingShapeOnMouseDown,
            'mouse:move': drawingShapeOnMouseMove,
            'mouse:up': stopShapeOnMouseUp,
        });
        btnIndex = i;
    });
}
let line, arrowHead1, arrowHead2;
let angle_text;
let angle_text_x, angle_text_y;
let mouseDown = false;
function addingShapeOnMouseDown(o){
    mouseDown = true;
    let pointer = canvas.getPointer(o.e);
    let linePath = 'M ' + pointer.x + ' ' + pointer.y + ' L ' + pointer.x + ' ' + pointer.y;
    line = new fabric.Path(linePath, {
        stroke: 'red',
        strokeWidth: 3,
        originX: 'center',
        originY: 'center',
        hasControls: false,
        hasBorders: false,
        objectCaching: false
    });
    canvas.add(line);
    let arrowHeadPath = 'M 0 0 L 20 10 L 0 20 Z';
    if(btnIndex===1 || btnIndex ===2){
        arrowHead1 = new fabric.Path(arrowHeadPath,{
            label: 'arrow-line',
            fill: 'red',
            stroke: '',
            strokeWidth: 0,
            originX: 'center',
            originY: 'center',
            hasControls: false,
            hasBorders: false,
            top: pointer.y,
            left: pointer.x
        });
        canvas.add(arrowHead1);
        if(btnIndex===2){
            arrowHead2 = new fabric.Path(arrowHeadPath,{
                label: 'arrow-line',
                fill: 'red',
                stroke: '',
                strokeWidth: 0,
                originX: 'center',
                originY: 'center',
                hasControls: false,
                hasBorders: false,
                top: pointer.y,
                left: pointer.x,
                angle: 180
            });
            canvas.add(arrowHead2);
        }
    }
    canvas.requestRenderAll();
}
function drawingShapeOnMouseMove(o){
    if(mouseDown===true){
        let pointer = canvas.getPointer(o.e);
        let startPointX = line.path[0][1];
        let startPointY = line.path[0][2];
        let endPointX = pointer.x;
        let endPointY = pointer.y;
        let width = Math.abs(pointer.x - startPointX);
        let height = Math.abs(pointer.y - startPointY);
        let sum = Math.pow(width,2) + Math.pow(height, 2);
        let lengthOfLine = Math.sqrt(sum);
        $('length-of-line').innerHTML = lengthOfLine.toFixed(1);
        let ratio = height / width;
        let angle = (Math.atan(ratio) / Math.PI) * 180;
        if(endPointX > startPointY){
            if(endPointY < startPointY){
                $('angle-of-line').innerHTML = (360 - angle).toFixed(1);
            }else if(endPointY > startPointY){
                $('angle-of-line').innerHTML = angle.toFixed(1);
            }else if(endPointY===startPointY){
                $('angle-of-line').innerHTML = (0).toFixed(1);
            }
        }else if(endPointX < startPointY){
            if(endPointY < startPointY){
                $('angle-of-line').innerHTML = (180 + angle).toFixed(1);
            }else if(endPointY > startPointY){
                $('angle-of-line').innerHTML = (180 - angle).toFixed(1);
            }else if(endPointY===startPointY){
                $('angle-of-line').innerHTML = (180).toFixed(1);
            }
        }else if(endPointX===startPointX){
            if(endPointY < startPointY){
                $('angle-of-line').innerHTML = (270).toFixed(1);
            }else if(endPointY > startPointY){
                $('angle-of-line').innerHTML = (90).toFixed(1);
            }else if(endPointY===startPointY){
                $('angle-of-line').innerHTML = (0).toFixed(1);
            }
        }
        line.path[1][1] = pointer.x;
        line.path[1][2] = pointer.y;
        line.setCoords();
        let centerX = getCenterCoords(startPointX, startPointY, line.path[1][1], line.path[1][2]).cx;
        let centerY = getCenterCoords(startPointX, startPointY, line.path[1][1], line.path[1][2]).cy;
        $('length-angle-container').style.left = centerX - 60 + 'px';
        $('length-angle-container').style.top = centerY - 10 + 'px';
        $('length-angle-container').style.display = 'block';
        angle_text = angle.toFixed(1);
        angle_text_x = centerY;
        angle_text_y = centerX;

        if(btnIndex===1 || btnIndex===2){
            arrowHead1.left = pointer.x;
            arrowHead1.top = pointer.y;
            if(btnIndex===1){
                if(arrowHead1.left>=startPointX){
                    if(arrowHead1.top<=startPointY){
                        arrowHead1.angle = 360 - angle;
                    }else if(arrowHead1.top> startPointY){
                        arrowHead1.angle = angle;
                    }
                }else{
                    if(arrowHead1.top<=startPointY){
                        arrowHead1.angle = 180 + angle;
                    }else if(arrowHead1.top>startPointY){
                        arrowHead1.angle = 180 - angle;
                    }
                }
                arrowHead1.setCoords();
            }else if(btnIndex===2){
                if(arrowHead1.left>=arrowHead2.left){
                    if(arrowHead1.top<=arrowHead2.top){
                        arrowHead1.angle = 360 - angle;
                        arrowHead2.angle = 360 - angle + 180;
                    }else if(arrowHead1.top>arrowHead2.top){
                        arrowHead1.angle = angle;
                        arrowHead2.angle = angle + 180;
                    }    
                }else{
                    if(arrowHead1.top<=arrowHead2.top){
                        arrowHead1.angle = 180 + angle;
                        arrowHead2.angle = 360 + angle;
                    }else if(arrowHead1.top>arrowHead2.top){
                        arrowHead1.angle = 180 - angle;
                        arrowHead2.angle = 360 - angle;
                    }
                }
                arrowHead1.setCoords();
                arrowHead2.setCoords();
            }
        }
        canvas.requestRenderAll();
    }
}
function stopShapeOnMouseUp(){
    mouseDown = false;
    let updateLinePath = line.path;
    canvas.remove(line);
    line = new fabric.Path(updateLinePath, {
        id: 'added-line',
        label: (btnIndex===1 || btnIndex===2) ? 'arrow-line' : '',
        stroke: 'red',
        strokeWidth: 3,
        originX: 'center',
        originY: 'center',
        hasControls: false,
        hasBorders: false,
        objectCaching: false,
        selectable: false
    });  
    canvas.add(line);
    if(btnIndex===1){
        canvas.bringToFront(arrowHead1);
        let objects = [];
        canvas.getObjects().forEach(o => {
            if(o.label==='arrow-line'){
                objects.push(o);
            }
        });
        let singleArrow = new fabric.Group(objects, {
            id: 'single-arrow',
            originX: 'center',
            originY: 'center',
            hasControls: false,
            hasBorders: false,
            objectCaching: false,
            selectable: false
        });
        canvas.add(singleArrow);
        canvas.remove(line, arrowHead1);
    }else if(btnIndex===2){
        canvas.bringToFront(arrowHead1);
        canvas.bringToFront(arrowHead2);
        let objects = [];
        canvas.getObjects().forEach(o => {
            if(o.label==='arrow-line'){
                objects.push(o);
            }
        });
        let doubleArrow = new fabric.Group(objects, {
            id: 'double-arrow',
            originX: 'center',
            originY: 'center',
            hasControls: false,
            hasBorders: false,
            objectCaching: false,
            selectable: false
        });
        canvas.add(doubleArrow);
        canvas.remove(line, arrowHead1, arrowHead2);
    }
    console.log(angle_text_x);
    console.log(angle_text_y);
    draw_text(angle_text_x, angle_text_y, angle_text);
    canvas.requestRenderAll();
}
function draw_text(sx, sy, str_txt){
    var txt1 = new fabric.Textbox(str_txt, {
        width: 150,
        top: sx,
        left: sy,
        fontSize: 20,
        stroke: 'black',
        textAlign: 'center',
        originX: 'center',
        originY: 'center',
        objectCaching: false
    });
    canvas.add(txt1);
}

$('deactivate-adding-shape-btn').addEventListener('click', deactivateMouseEvents);

function deactivateMouseEvents(){
    canvas.getObjects().forEach(o => {
        o.selectable = true;
        o.hasBorders = true;
        // o.hasControls = true;
    });
    canvas.off({
        'mouse:down': addingShapeOnMouseDown,
        'mouse:move': drawingShapeOnMouseMove,
        'mouse:up': stopShapeOnMouseUp,
    });  
    $('deactivate-adding-shape-btn').style.display = 'none'; 
    $('length-angle-container').style.display = 'none';
}
function getCenterCoords(sx,sy,ex,ey){
    let cx = (sx + ex) / 2;
    let cy = (sy + ey) / 2;
    return{
        cx: cx,
        cy: cy
    }
}