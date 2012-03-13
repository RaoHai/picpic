<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;

	$src = 'flowers.jpg';
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	header('Content-type: image/jpeg');
	imagejpeg($dst_r,null,$jpeg_quality);

	exit;
}

// If not a POST request, display page below:

?><html>
	<head>

		<script src="/jquery.min.js"></script>
		<script src="/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="/jquery.Jcrop.css" type="text/css" />


		<script language="Javascript">

			$(function(){

				$('#cropbox').Jcrop({
					aspectRatio: 1,
					onSelect: updateCoords,
					 onChange: updatePreview,
				},function(){
				// Use the API to get the real image size
				var bounds = this.getBounds();
				boundx = bounds[0];
				boundy = bounds[1];
				// Store the API in the jcrop_api variable
				jcrop_api = this;
			  });
			function updatePreview(c)
				  {
					if (parseInt(c.w) > 0)
					{
					  var rx = 100 / c.w;
					  var ry = 100 / c.h;

					  $('#preview').css({
						width: Math.round(rx * boundx) + 'px',
						height: Math.round(ry * boundy) + 'px',
						marginLeft: '-' + Math.round(rx * c.x) + 'px',
						marginTop: '-' + Math.round(ry * c.y) + 'px'
					  });
					}
				  };

			});

			function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region then press submit.');
				return false;
			};
			

		</script>

	</head>

	<body>

	<div id="outer">
	<div class="jcExample">
	<div class="article">
		<div style="float:left"><img src="flowers.jpg" id="cropbox"/></div>
		<div style="width:100px;height:100px;overflow:hidden;">
						<img src="flowers.jpg" id="preview" alt="Preview" />
		</div>
		<!-- This is the form that our event handler fills -->
		<form action="crop.php" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="submit" value="Crop Image" />
		</form>


	</div>
	</div>
	</div>
	</body>

</html>
