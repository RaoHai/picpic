<?php
header('Content-type: image/jpeg');
$img=imageCreate(300,200);	//创建画布
$background=ImageColorAllocate($img,255,255,255);
imageJpeg($img);

//销毁图像
imageDestroy($img);


?>
