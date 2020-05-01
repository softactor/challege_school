var canvas = new fabric.Canvas('c', {
	width:fabric.util.parseUnit('{{$row->page_width}}'+'mm'),
	height:fabric.util.parseUnit('{{$row->page_height}}'+'mm'),
});

// ######################## Header Image #############################################
var header_image_url = $("#header_image_url").val();
if (header_image_url && header_image_url.length > 0) {
	fabric.Image.fromURL(header_image_url, function(headerImg) {
	 //i create an extra var for to change some image properties
	 var headerImage = headerImg.set({ left: 0, top: 0 });
		canvas.add(headerImage); 
	});
}
// ######################## Header Image #############################################

// ######################## Load canvas from Database ################################
var json = "{{$row->template_data}}";
if(json != ''){
var json = JSON.parse(json.replace(/&quot;/g,'"'));
canvas.loadFromJSON(json, canvas.renderAll.bind(canvas), function(o, object) {
    // fabric.log(o, object);
});
}
// ######################## Load canvas from Database ################################

$( ".top-control" ).each(function( index ) {
  $(this).attr('max',fabric.util.parseUnit('{{$row->page_height}}'+'mm'));
});

$( ".left-control" ).each(function( index ) {
  $(this).attr('max',fabric.util.parseUnit('{{$row->page_width}}'+'mm'));
});

var canvasOriginalWidth = canvas.width,
    canvasOriginalHeight = canvas.height,
    canvasWidth = canvas.width,
    canvasHeight = canvas.height,
    imgWidth,
    imgHeight,
    bgImage,
    canvasScale = 1;

//################### Cover background color for text ##################
fabric.Textbox.prototype.set({
  _getNonTransformedDimensions() { // Object dimensions
    return new fabric.Point(this.width, this.height).scalarAdd(this.padding);
  },
  _calculateCurrentDimensions() { // Controls dimensions
    return fabric.util.transformPoint(this._getTransformedDimensions(), this.getViewportTransform(), true);
  }
});
//################### Cover background color for text ##################
// ################## Background Theme ################################
$(document).on("click", ".theme", function(){
    var url = $(this).attr("src");
	setCanvasBackgroundImageUrl(url);
	// canvas.setBackgroundImage(url, canvas.renderAll.bind(canvas), {
		// backgroundImageOpacity: 0.5,
		// backgroundImageStretch: false
	// });
});

function setCanvasBackgroundImageUrl(url) {
	if (url && url.length > 0) {
		fabric.Image.fromURL(url, function (img) {
			bgImage = img;
			scaleAndPositionImage();
		});
	} else {
		canvas.backgroundImage = 0;
		canvas.setBackgroundImage('', canvas.renderAll.bind(canvas));

		canvas.renderAll();
	}
}
function scaleAndPositionImage() {
	// setCanvasZoom();

	var canvasAspect = canvasWidth / canvasHeight;
	var imgAspect = bgImage.width / bgImage.height;
	var left, top, scaleFactor;

	if (canvasAspect >= imgAspect) {
		var scaleFactor = canvasWidth / bgImage.width;
		left = 0;
		top = -((bgImage.height * scaleFactor) - canvasHeight) / 2;
	} else {
		var scaleFactor = canvasHeight / bgImage.height;
		top = 0;
		left = -((bgImage.width * scaleFactor) - canvasWidth) / 2;

	}

	canvas.setBackgroundImage(bgImage, canvas.renderAll.bind(canvas), {
		top: top,
		left: left,
		originX: 'left',
		originY: 'top',
		scaleX: scaleFactor,
		scaleY: scaleFactor
	});
	canvas.renderAll();

}
function setCanvasZoom() {
	canvasWidth = canvasOriginalWidth * canvasScale;
	canvasHeight = canvasOriginalHeight * canvasScale;

	canvas.setWidth(canvasWidth);
	canvas.setHeight(canvasHeight);
}
// ################## Background Theme ################################

// ################## Import Template #################################
function onChange(event) {
	var reader = new FileReader();
	reader.onload = onReaderLoad;
	reader.readAsText(event.target.files[0]);
}

function onReaderLoad(event){
	var obj = event.target.result;
	canvas.loadFromJSON(obj, canvas.renderAll.bind(canvas), function(o, object) {
		// fabric.log(o, object);
	});
	// alert_data(obj.name, obj.family);
}

document.getElementById('import_json').addEventListener('change', onChange);
// ################## Import Template #################################
document.getElementById('imgLoader').onchange = function handleImage(e) {
var reader = new FileReader();
  reader.onload = function (event){
    var imgObj = new Image();
    imgObj.src = event.target.result;
    imgObj.onload = function () {
      var image = new fabric.Image(imgObj);
      image.set({
            angle: 0,
            padding: 10,
            cornersize:10,
            height:image.height,
            width:image.width,
            //scaleX: 0.3,
            //scaleY: 0.3,
            //clipTo: roundedCorners.bind(image)
      });
      canvas.centerObject(image);
      canvas.add(image);
      canvas.renderAll();
    }
  }
  reader.readAsDataURL(e.target.files[0]);
}


/* image round */
/*$('#round-img').on('click',function(){
    function roundedCorners(ctx) {
      var rect = new fabric.Rect({
        left:0,
        top:0,
        rx:70 / this.scaleX,
        ry:70 / this.scaleY,
        width:this.width,
        height:this.height,
        fill:'#000000'
      });
      rect._render(ctx, false);
  }
})*/
grid = 50;

// grid
// for (var i = 0; i < (canvas.width / grid); i++) {
    // canvas.add(new fabric.Line([ i * grid, 0, i * grid, canvas.width], { stroke: '#ccc', selectable: false }));
    // canvas.add(new fabric.Line([ 0, i * grid, canvas.width, i * grid], { stroke: '#ccc', selectable: false }));
// }
	var i=0;
	while((i*grid)<=canvas.height){
		canvas.add(new fabric.Line([ 0,i * grid,canvas.width,i * grid ], { stroke: '#ccc', selectable: false }));
		i++;
	}
	var j=0;
	while((j*grid)<=canvas.width){
		canvas.add(new fabric.Line([ j * grid,0, j * grid, canvas.height], { stroke: '#ccc', selectable: false }));
		j++;
	}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function saveCanvas()
{
  // convert canvas to a json string
  var objects = canvas.getObjects('line');
    for (let i in objects) {
        canvas.remove(objects[i]);
    }
    var json = JSON.stringify( canvas.toJSON() );
  var template_id = {{$template_id}};
  $.ajax({
           type:'POST',
           url:'{{route('saveDesignTemplate')}}',
           data:{json:json,template_id:template_id},
           success:function(data){
			   var i=0;
	while((i*grid)<=canvas.height){
		canvas.add(new fabric.Line([ 0,i * grid,canvas.width,i * grid ], { stroke: '#ccc', selectable: false }));
		i++;
	}
	var j=0;
	while((j*grid)<=canvas.width){
		canvas.add(new fabric.Line([ j * grid,0, j * grid, canvas.height], { stroke: '#ccc', selectable: false }));
		j++;
	}
              alert(data.success);
           }
        });
}

// Grid display part
// for (var i = 0; i < (600 / grid); i++) {
  // canvas.add(new fabric.Line([ i * grid, 0, i * grid, 600], { stroke: '#ccc', selectable: false }));
  // canvas.add(new fabric.Line([ 0, i * grid, 600, i * grid], { stroke: '#ccc', selectable: false }))
// }

//Force To set
// Snapping part
// canvas.on('object:moving', function(options) {
  // options.target.set({
    // left: Math.round(options.target.left / 50) * 50,
    // top: Math.round(options.target.top / 50) * 50
  // });
// });

// Set if use wants
canvas.on('object:moving', function(options) {
  if (Math.round(options.target.left / grid * 4) % 4 == 0 &&
    Math.round(options.target.top / grid * 4) % 4 == 0) {
    options.target.set({
      left: Math.round(options.target.left / grid) * grid,
      top: Math.round(options.target.top / grid) * grid
    }).setCoords();
  }
});

//################## For partition ####################################
var line50 = new fabric.Line([
  canvas.width / 2, 0,
  canvas.width / 2, canvas.height
],{
  strokeDashArray: [5, 5],
  stroke: 'green',
})
line50.selectable = false;
line50.evented = false;
line50.set('id','line50');

var line30 = new fabric.Line([
  canvas.width / 3, 0,
  canvas.width / 3, canvas.height
],{
  strokeDashArray: [5, 5],
  stroke: 'green',
})
line30.selectable = false;
line30.evented = false;
line30.set('id','line30');

var line70 = new fabric.Line([
  canvas.width / 3 * 2, 0,
  canvas.width / 3 * 2, canvas.height
],{
  strokeDashArray: [5, 5],
  stroke: 'green',
})
line70.selectable = false;
line70.evented = false;
line70.set('id','line70');

function AddLayout_33_33()
{
	// canvas.remove(line50);
	canvas.forEachObject(function(obj) {
		if (obj.id && obj.id === 'line50') {
			canvas.remove(obj);
		}
	});
	canvas.add(line30);
	canvas.add(line70);
}

function AddLayout_30_70()
{
	// canvas.remove(line70);
	canvas.forEachObject(function(obj) {
		if (obj.id && obj.id === 'line70') {
			canvas.remove(obj);
		}
	});
	// canvas.remove(line50);
	canvas.forEachObject(function(obj) {
		if (obj.id && obj.id === 'line50') {
			canvas.remove(obj);
		}
	});
	canvas.add(line30);
}

function AddLayout_50_50()
{
	// canvas.remove(line30);
	canvas.forEachObject(function(obj) {
		if (obj.id && obj.id === 'line30') {
			canvas.remove(obj);
		}
	});
	// canvas.remove(line70);
	canvas.forEachObject(function(obj) {
		if (obj.id && obj.id === 'line70') {
			canvas.remove(obj);
		}
	});
	canvas.add(line50);
}

function AddLayout_100()
{
	// canvas.remove(line30);
	canvas.forEachObject(function(obj) {
		if (obj.id && obj.id === 'line30') {
			canvas.remove(obj);
		}
	});
	// canvas.remove(line70);
	canvas.forEachObject(function(obj) {
		if (obj.id && obj.id === 'line70') {
			canvas.remove(obj);
		}
	});
	
	canvas.forEachObject(function(obj) {
		if (obj.id && obj.id === 'line50') {
			canvas.remove(obj);
		}
	});
}

// canvas.add(line30);
// canvas.add(line70);
// canvas.add(line50);
//################## For partition ####################################
//################## Canvas Row/Column ################################
// var grid = 60;

// create grid
// for (var i = 0; i < (800 / grid); i++) {
  // canvas.add(new fabric.Line([ i * grid, 0, i * grid, 600], { stroke: '#ccc', selectable: false }));
  // canvas.add(new fabric.Line([ 0, i * grid, 600, i * grid], { stroke: '#ccc', selectable: false }))
// }
//################## Canvas Row/Column ################################
// rect = new fabric.Rect({
    // left: 40,
    // top: 40,
    // width: 50,
    // height: 50,
    // fill: 'transparent',
    // stroke: 'green',
    // strokeWidth: 5 });

  // canvas.add(rect);
  function Addserialnumber()
  {
    var serialnumber = new fabric.Textbox('Serial Number', {
    left: 20,
    top: 50,
    fill: '#646161',
    width:250,
    strokeWidth: 1,
    stroke: "#646161",
	id: "serial_number",
    });

    canvas.add(serialnumber);
  }
  
  function Addsalutation()
  {
    var salutation = new fabric.Textbox('Salutation', {
    left: 20,
    top: 50,
    fill: '#646161',
    width:200,
    strokeWidth: 1,
    stroke: "#646161",
	id: "salutation",
    });

    canvas.add(salutation);
  }

  function Addfirstname()
  {
    var firstname = new fabric.Textbox('First Name', {
    left: 20,
    top: 50,
    fill: '#646161',
    width:200,
    strokeWidth: 1,
    stroke: "#646161",
	id: "first_name",
    });

    canvas.add(firstname);
  }

  function Addlastname()
  {
    var lastname = new fabric.Textbox('Last Name', {
    left: 20,
    top: 50,
    fill: '#646161',
    width:200,
    strokeWidth: 1,
    stroke: "#646161",
	id: "last_name",
    });

    canvas.add(lastname);
  }

  function Addemail()
  {
    var email = new fabric.Textbox('Email', {
    left: 20,
    top: 50,
    fill: '#646161',
    width:200,
    strokeWidth: 1,
    stroke: "#646161",
	id: "email",
    });

    canvas.add(email);
  }

  function Addtype()
  {
    var type = new fabric.Textbox('Type', {
    left: 20,
    top: 50,
    fill: '#646161',
    width:200,
    strokeWidth: 1,
    stroke: "#646161",
	id: "user_type",
    });

    canvas.add(type);
  }

  function Addcountry()
  {
    var country = new fabric.Textbox('Country', {
    left: 20,
    top: 50,
    fill: '#646161',
    width:200,
    strokeWidth: 1,
    stroke: "#646161",
	id: "country",
    });

    canvas.add(country);
  }

  function Addcompany()
  {
    var company = new fabric.Textbox('Company', {
    left: 20,
    top: 50,
    fill: '#646161',
    width:200,
    strokeWidth: 1,
    stroke: "#646161",
	id: "company",
    });

    canvas.add(company);
  }

  function qrcode(){
    var object = new fabric.Rect({
                    width: 100,
                    height: 100,
                    opacity: 1,
                    fill: '#fff',
                    stroke: '#000',
                    strokeWidth: 2,
                    left: 0,
                    top: 0,
					id: 'qrcode'
    });
    canvas.add(object);
  }
  
  function barcode(){
    var object = new fabric.Rect({
                    width: 200,
                    height: 50,
                    opacity: 1,
                    fill: '#fff',
                    stroke: '#000',
                    strokeWidth: 2,
                    left: 0,
                    top: 0,
					id: 'barcode'
    });
    canvas.add(object);
  }
  <!--###################################-->
  // ######################## For the snap alignment Start   #################################
  var ctx = canvas.getSelectionContext(),
      aligningLineOffset = 5,
      aligningLineMargin = 4,
      aligningLineWidth = 1,
      aligningLineColor = 'rgb(0,255,0)',
      viewportTransform,
      zoom = 1;

  function drawVerticalLine(coords) {
    drawLine(
      coords.x + 0.5,
      coords.y1 > coords.y2 ? coords.y2 : coords.y1,
      coords.x + 0.5,
      coords.y2 > coords.y1 ? coords.y2 : coords.y1);
  }

  function drawHorizontalLine(coords) {
    drawLine(
      coords.x1 > coords.x2 ? coords.x2 : coords.x1,
      coords.y + 0.5,
      coords.x2 > coords.x1 ? coords.x2 : coords.x1,
      coords.y + 0.5);
  }

  function drawLine(x1, y1, x2, y2) {
    ctx.save();
    ctx.lineWidth = aligningLineWidth;
    ctx.strokeStyle = aligningLineColor;
    ctx.beginPath();
    ctx.moveTo(((x1+viewportTransform[4])*zoom), ((y1+viewportTransform[5])*zoom));
    ctx.lineTo(((x2+viewportTransform[4])*zoom), ((y2+viewportTransform[5])*zoom));
    ctx.stroke();
    ctx.restore();
  }

  function isInRange(value1, value2) {
    value1 = Math.round(value1);
    value2 = Math.round(value2);
    for (var i = value1 - aligningLineMargin, len = value1 + aligningLineMargin; i <= len; i++) {
      if (i === value2) {
        return true;
      }
    }
    return false;
  }

  var verticalLines = [],
      horizontalLines = [];

  canvas.on('mouse:down', function () {
    viewportTransform = canvas.viewportTransform;
    zoom = canvas.getZoom();
  });

  canvas.on('object:moving', function(e) {

    var activeObject = e.target,
        canvasObjects = canvas.getObjects(),
        activeObjectCenter = activeObject.getCenterPoint(),
        activeObjectLeft = activeObjectCenter.x,
        activeObjectTop = activeObjectCenter.y,
        activeObjectBoundingRect = activeObject.getBoundingRect(),
        activeObjectHeight = activeObjectBoundingRect.height / viewportTransform[3],
        activeObjectWidth = activeObjectBoundingRect.width / viewportTransform[0],
        horizontalInTheRange = false,
        verticalInTheRange = false,
        transform = canvas._currentTransform;

    if (!transform) return;

    // It should be trivial to DRY this up by encapsulating (repeating) creation of x1, x2, y1, and y2 into functions,
    // but we're not doing it here for perf. reasons -- as this a function that's invoked on every mouse move

    for (var i = canvasObjects.length; i--; ) {

      if (canvasObjects[i] === activeObject) continue;

      var objectCenter = canvasObjects[i].getCenterPoint(),
          objectLeft = objectCenter.x,
          objectTop = objectCenter.y,
          objectBoundingRect = canvasObjects[i].getBoundingRect(),
          objectHeight = objectBoundingRect.height / viewportTransform[3],
          objectWidth = objectBoundingRect.width / viewportTransform[0];

      // snap by the horizontal center line
      if (isInRange(objectLeft, activeObjectLeft)) {
        verticalInTheRange = true;
        verticalLines.push({
          x: objectLeft,
          y1: (objectTop < activeObjectTop)
            ? (objectTop - objectHeight / 2 - aligningLineOffset)
            : (objectTop + objectHeight / 2 + aligningLineOffset),
          y2: (activeObjectTop > objectTop)
            ? (activeObjectTop + activeObjectHeight / 2 + aligningLineOffset)
            : (activeObjectTop - activeObjectHeight / 2 - aligningLineOffset)
        });
        activeObject.setPositionByOrigin(new fabric.Point(objectLeft, activeObjectTop), 'center', 'center');
      }

      // snap by the left edge
      if (isInRange(objectLeft - objectWidth / 2, activeObjectLeft - activeObjectWidth / 2)) {
        verticalInTheRange = true;
        verticalLines.push({
          x: objectLeft - objectWidth / 2,
          y1: (objectTop < activeObjectTop)
            ? (objectTop - objectHeight / 2 - aligningLineOffset)
            : (objectTop + objectHeight / 2 + aligningLineOffset),
          y2: (activeObjectTop > objectTop)
            ? (activeObjectTop + activeObjectHeight / 2 + aligningLineOffset)
            : (activeObjectTop - activeObjectHeight / 2 - aligningLineOffset)
        });
        activeObject.setPositionByOrigin(new fabric.Point(objectLeft - objectWidth / 2 + activeObjectWidth / 2, activeObjectTop), 'center', 'center');
      }

      // snap by the right edge
      if (isInRange(objectLeft + objectWidth / 2, activeObjectLeft + activeObjectWidth / 2)) {
        verticalInTheRange = true;
        verticalLines.push({
          x: objectLeft + objectWidth / 2,
          y1: (objectTop < activeObjectTop)
            ? (objectTop - objectHeight / 2 - aligningLineOffset)
            : (objectTop + objectHeight / 2 + aligningLineOffset),
          y2: (activeObjectTop > objectTop)
            ? (activeObjectTop + activeObjectHeight / 2 + aligningLineOffset)
            : (activeObjectTop - activeObjectHeight / 2 - aligningLineOffset)
        });
        activeObject.setPositionByOrigin(new fabric.Point(objectLeft + objectWidth / 2 - activeObjectWidth / 2, activeObjectTop), 'center', 'center');
      }

      // snap by the vertical center line
      if (isInRange(objectTop, activeObjectTop)) {
        horizontalInTheRange = true;
        horizontalLines.push({
          y: objectTop,
          x1: (objectLeft < activeObjectLeft)
            ? (objectLeft - objectWidth / 2 - aligningLineOffset)
            : (objectLeft + objectWidth / 2 + aligningLineOffset),
          x2: (activeObjectLeft > objectLeft)
            ? (activeObjectLeft + activeObjectWidth / 2 + aligningLineOffset)
            : (activeObjectLeft - activeObjectWidth / 2 - aligningLineOffset)
        });
        activeObject.setPositionByOrigin(new fabric.Point(activeObjectLeft, objectTop), 'center', 'center');
      }

      // snap by the top edge
      if (isInRange(objectTop - objectHeight / 2, activeObjectTop - activeObjectHeight / 2)) {
        horizontalInTheRange = true;
        horizontalLines.push({
          y: objectTop - objectHeight / 2,
          x1: (objectLeft < activeObjectLeft)
            ? (objectLeft - objectWidth / 2 - aligningLineOffset)
            : (objectLeft + objectWidth / 2 + aligningLineOffset),
          x2: (activeObjectLeft > objectLeft)
            ? (activeObjectLeft + activeObjectWidth / 2 + aligningLineOffset)
            : (activeObjectLeft - activeObjectWidth / 2 - aligningLineOffset)
        });
        activeObject.setPositionByOrigin(new fabric.Point(activeObjectLeft, objectTop - objectHeight / 2 + activeObjectHeight / 2), 'center', 'center');
      }

      // snap by the bottom edge
      if (isInRange(objectTop + objectHeight / 2, activeObjectTop + activeObjectHeight / 2)) {
        horizontalInTheRange = true;
        horizontalLines.push({
          y: objectTop + objectHeight / 2,
          x1: (objectLeft < activeObjectLeft)
            ? (objectLeft - objectWidth / 2 - aligningLineOffset)
            : (objectLeft + objectWidth / 2 + aligningLineOffset),
          x2: (activeObjectLeft > objectLeft)
            ? (activeObjectLeft + activeObjectWidth / 2 + aligningLineOffset)
            : (activeObjectLeft - activeObjectWidth / 2 - aligningLineOffset)
        });
        activeObject.setPositionByOrigin(new fabric.Point(activeObjectLeft, objectTop + objectHeight / 2 - activeObjectHeight / 2), 'center', 'center');
      }
    }

    if (!horizontalInTheRange) {
      horizontalLines.length = 0;
    }

    if (!verticalInTheRange) {
      verticalLines.length = 0;
    }
  });

  canvas.on('before:render', function() {
    canvas.clearContext(canvas.contextTop);
  });

  canvas.on('after:render', function() {
    for (var i = verticalLines.length; i--; ) {
      drawVerticalLine(verticalLines[i]);
    }
    for (var i = horizontalLines.length; i--; ) {
      drawHorizontalLine(horizontalLines[i]);
    }

    verticalLines.length = horizontalLines.length = 0;
  });

  canvas.on('mouse:up', function() {
    verticalLines.length = horizontalLines.length = 0;
    canvas.renderAll();
  });
  // ######################## For the snap alignment Start   #################################

  $("#remove_selected").on('click',function(){
    var activeObjects = canvas.getActiveObjects();
      canvas.discardActiveObject()
      if (activeObjects.length) {
        canvas.remove.apply(canvas, activeObjects);
      }
  })

  //###################### set property ##############################
  $("#font_size").on('change',function(){
    var size = $('#font_size option:selected').text();
    canvas.getActiveObject().set("fontSize", size);
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
  });

  $("#font_family").on('change',function(){
    var font = $("#font_family option:selected").val();
    canvas.getActiveObject().set("fontFamily", font);
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
  });

  $("#line_height").on('change',function(){
    var line = $("#line_height option:selected").text();
    canvas.getActiveObject().set("lineHeight", line);
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
  });
  
  $("#margin_left").on('input',function(){
	canvas.getActiveObject().set('left', parseInt(this.value, 10)).setCoords();
    canvas.requestRenderAll();
  });
  
  $("#margin_top").on('input',function(){
	canvas.getActiveObject().set('top', parseInt(this.value, 10)).setCoords();
    canvas.requestRenderAll();
  });
  
  $("#padding_control").on('input',function(){
	canvas.getActiveObject().set('padding', parseInt(this.value, 10)).setCoords();
    canvas.requestRenderAll();
  });

  var underline = document.getElementById('underline');
  var bold = document.getElementById('bold');
  var italic = document.getElementById('italic');

  underline.addEventListener('click', function() {
    dtEditText('underline');
  });

  bold.addEventListener('click', function() {
  dtEditText('bold');
  }); 

  italic.addEventListener('click', function() {
    dtEditText('italic');
  });   

  function dtEditText(action) {
    var a = action;
    var o = canvas.getActiveObject();
    var t;

    // If object selected, what type?
    if (o) {
        t = o.get('type');
    }

    if (o && t === 'textbox') {
      switch(a) {
          case 'bold':        
              var isBold = dtGetStyle(o, 'fontWeight') === 'bold';
              dtSetStyle(o, 'fontWeight', isBold ? '' : 'bold');
          break;

          case 'italic':
              var isItalic = dtGetStyle(o, 'fontStyle') === 'italic';
              dtSetStyle(o, 'fontStyle', isItalic ? '' : 'italic');
          break;

          case 'underline':
              var isUnderline = dtGetStyle(o, 'textDecoration') === 'underline';
              dtSetStyle(o, 'textDecoration', isUnderline ? '' : 'textDecoration');
              alert(isUnderline);
          break;

          canvas.renderAll();
      }
    }
}

// Get the style
function dtGetStyle(object, styleName) {
    return object[styleName];
}

// Set the style
function dtSetStyle(object, styleName, value) {
    object[styleName] = value;
    object.set({dirty: true});
    canvas.renderAll();
}

$("#subscript").on('click', function() {
    canvas.getActiveObject().setSubscript();
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
});

$("#superscript").on('click', function() {
    canvas.getActiveObject().setSuperscript();
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
});

$("#removeScript").on('click', function() {
    canvas.getActiveObject().setSelectionStyles({
    fontSize: undefined,
    deltaY: undefined,
  });
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
});

$("#fill_color").on('change',function() {
    var color = document.getElementById('fill_color').value;
    canvas.getActiveObject().set("fill", color);
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
});

$("#stroke_color").on('change',function() {
    var color = document.getElementById('stroke_color').value;
    canvas.getActiveObject().set("stroke", color);
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
});

$("#background_color").on('change',function() {
    var color = document.getElementById('background_color').value;
    canvas.getActiveObject().set("backgroundColor", color).setCoords();
    canvas.renderAll();
    // canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    // canvas.renderAll();
});

$("#text-align").on('change', function(){
   var align = document.getElementById('text-align').value;
    canvas.getActiveObject().set("textAlign", align);
    canvas.trigger("object:modified",{target: canvas.getActiveObject()});
    canvas.renderAll();
});

$(document).ready(function(){
  $("#image-property").hide();
})
canvas.on('mouse:down', function() {
  var object = (canvas.getActiveObject() != null) ? canvas.getActiveObject().type : '';
  
  if(object == 'image'){
    $("#text-property").hide();
    $("#image-property").show();
  }else if(object == 'textbox'){
    $("#text-property").show();
    $("#image-property").hide();
  }else{
    $("#text-property").show();
  }
});

//######################## image property #######################################

f = fabric.Image.filters;

function applyFilter(index, filter) {
    var obj = canvas.getActiveObject();
    obj.filters[index] = filter;
    var timeStart = +new Date();
    obj.applyFilters();
    var timeEnd = +new Date();
    var dimString = canvas.getActiveObject().width + ' x ' +
      canvas.getActiveObject().height;
    $('bench').innerHTML = dimString + 'px ' +
      parseFloat(timeEnd-timeStart) + 'ms';
    canvas.renderAll();
  }

function applyFilterValue(index, prop, value) {
    var obj = canvas.getActiveObject();
    if (obj.filters[index]) {
      obj.filters[index][prop] = value;
      var timeStart = +new Date();
      obj.applyFilters();
      var timeEnd = +new Date();
      var dimString = canvas.getActiveObject().width + ' x ' +
        canvas.getActiveObject().height;
      $('bench').innerHTML = dimString + 'px ' +
        parseFloat(timeEnd-timeStart) + 'ms';
      canvas.renderAll();
    }
  }

  var object = (canvas.getActiveObject() != null) ? canvas.getActiveObject().type : '';
  if( object == 'image' ){
    canvas.on({
      'object:selected': function() {
        fabric.util.toArray(document.getElementsByTagName('input'))
                            .forEach(function(el){ el.disabled = false; })

        var filters = ['grayscale', 'invert', 'sepia', 'brownie','brightness', 'contrast', 'saturation',
        'vintage','blur', 'technicolor','polaroid', 'gamma', 'kodachrome','blackwhite', 'hue'];

        for (var i = 0; i < filters.length; i++) {
          $(filters[i]) && (
          $(filters[i]).checked = !!canvas.getActiveObject().filters[i]);
        }
      },
      'selection:cleared': function() {
        fabric.util.toArray(document.getElementsByTagName('input'))
                            .forEach(function(el){ el.disabled = true; })
      }
    });
  }
  
  $("#image_left").on('input',function(){
	canvas.getActiveObject().set('left', parseInt(this.value, 10)).setCoords();
    canvas.requestRenderAll();
  });
  
  $("#image_top").on('input',function(){
	canvas.getActiveObject().set('top', parseInt(this.value, 10)).setCoords();
    canvas.requestRenderAll();
  });
  
$('#grayscale').on('click' ,function() {
  applyFilter(0, this.checked && new f.Grayscale());
});
$('#average').on('click', function() {
  applyFilterValue(0, 'mode', 'average');
});
$('#luminosity').on('click', function() {
  applyFilterValue(0, 'mode', 'luminosity');
});
$('#lightness').on('click', function() {
  applyFilterValue(0, 'mode', 'lightness');
});

$("#invert").on('click',function() {
    applyFilter(1, this.checked && new f.Invert());
});

$('#sepia').on('click' ,function() {
    applyFilter(2, this.checked && new f.Sepia());
});

$('#blackwhite').on('click' ,function() {
    applyFilter(13, this.checked && new f.BlackWhite());
});

$('#brownie').on('click' ,function() {
    applyFilter(3, this.checked && new f.Brownie());
});

$('#vintage').on('click' ,function() {
    applyFilter(7, this.checked && new f.Vintage());
});

$('#kodachrome').on('click' ,function() {
    applyFilter(12, this.checked && new f.Kodachrome());
});

$('#technicolor').on('click' ,function() {
    applyFilter(9, this.checked && new f.Technicolor());
});

$('#polaroid').on('click' ,function() {
    applyFilter(10, this.checked && new f.Polaroid());
});

$('#brightness').on('click', function () {
  var align = document.getElementById('brightness-value').value;
  alert(align)
  applyFilter(4, this.checked && new f.Brightness({
    brightness: parseFloat($('#brightness-value').value)
  }));
});
$('#brightness-value').on('change', function() {
  applyFilterValue(4, 'brightness', parseFloat(this.value));
});