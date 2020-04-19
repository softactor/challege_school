@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <!-- Canvas Area -->
      <div class="col-md-9" style="display:inline-block;">
				<canvas id="c" width="800" height="500" style="border:1px solid grey"></canvas>
      </div>
      <!-- end Canvas Area -->
      <div class="col-md-3">
				<ul class="field-list">
          <li><input type="file" id="imgLoader" aria-label="File browser example"></li>
					<li onclick="Addserialnumber()">Serial Number</li>
					<li onclick="Addsalutation()">Salutation</li>
					<li onclick="Addfirstname()">First Name</li>
					<li onclick="Addlastname()">Last Name</li>
					<li onclick="Addemail()">Email</li>
					<li onclick="Addtype()">Type</li>
					<li onclick="Addcountry()">Country</li>
					<li onclick="Addcompany()">Company</li>
				</ul>
      </div>
    </div>
        <!--<div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>-->
	
			<!-- Field area -->
			<!-- Canvas Area -->
    </div>
</div>

@endsection

@section('page-script')
<script>
// var canvas = new fabric.Canvas('c');
var canvas = new fabric.Canvas('c', {
        width:800,
		// width:fabric.util.parseUnit('297mm'),
		// height:fabric.util.parseUnit('210mm'),
        height:500
    });
// canvas.setBackgroundImage('https://cdn.pixabay.com/photo/2016/03/09/11/44/network-1246209_960_720.jpg', canvas.renderAll.bind(canvas));

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
      });
      canvas.centerObject(image);
      canvas.add(image);
      canvas.renderAll();
    }
  }
  reader.readAsDataURL(e.target.files[0]);
}

grid = 50;

// grid
for (var i = 0; i < (canvas.width / grid); i++) {
    canvas.add(new fabric.Line([ i * grid, 0, i * grid, canvas.width], { stroke: '#ccc', selectable: false }));
    canvas.add(new fabric.Line([ 0, i * grid, canvas.width, i * grid], { stroke: '#ccc', selectable: false }));
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
var line9 = new fabric.Line([
  canvas.width / 3, 0,
  canvas.width / 3, canvas.height
],{
  strokeDashArray: [5, 5],
  stroke: 'green',
})

 line9.selectable = false;
line9.evented = false;
 canvas.add(line9);

var line8 = new fabric.Line([
  canvas.width / 3 * 2, 0,
  canvas.width / 3 * 2, canvas.height
],{
  strokeDashArray: [5, 5],
  stroke: 'green',
})

line8.selectable = false;
line8.evented = false;
canvas.add(line8);
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
		});

		canvas.add(company);
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
</script>
@endsection

