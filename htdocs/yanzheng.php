<?php  
  
/********************************* 
 
* Code by Gently 
 
* 24/07/07 
 
*������������֤��Ϊ����������ɣ���ĳ���ɺϡ��Ĵ������������������ 
 
*ĳЩ�������ĵ��˲�Ҫ���ⷢ�ӣ� 
 
*********************************/  
  
session_start();  
 
header("Content-type: image/PNG");  
  
$w=180;  
  
$h=60;  
  
$fontface="ABF.ttf";  //�����ļ���������ָ��  
  
$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
$code="";  
  
for($i=0;$i<4;$i++){  
  
  $Xi=mt_rand(0,strlen($str)/2);  
  
  if($Xi%2) $Xi+=1;  
  
  $code.=substr($str,$Xi,2);  

}  
	 for($i=0;$i<4;$i++){ 
	$c.=iconv("GB2312","UTF-8",substr($code,$i*2,2)); 
	}
	$_SESSION['code']=$c; //��ֵ��SESSION
 $im=imagecreatetruecolor($w,$h);
 $bkcolor=imagecolorallocate($im,250,250,250); 
 imagefill($im,0,0,$bkcolor); /***��Ӹ���***/ 
 for($i=0;$i<15;$i++){ 
	 $fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)); 
	 imagearc($im,mt_rand(-10,$w),mt_rand(-10,$h),mt_rand(30,300),mt_rand(20,200),55,44,$fontcolor);
 } 
 for($i=0;$i<255;$i++){
	 $fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	 imagesetpixel($im,mt_rand(0,$w),mt_rand(0,$h),$fontcolor); 
 } /***********����*********/ 
 for($i=0;$i<4;$i++){ 
	 $fontcolor=imagecolorallocate($im,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120)); //������֤�����������ɫ���
	 $codex=iconv("GB2312","UTF-8",substr($code,$i*2,2)); 
	 imagettftext($im,mt_rand(20,24),mt_rand(-60,60),40*$i+20,mt_rand(30,35),$fontcolor,$fontface,$codex); 
 }
	imagepng($im); 
 
 ?>