<?php 
session_start(); 
$authnum=random(4);//��֤���ַ�. 
$_SESSION["yan"]=$authnum; 
//������֤��ͼƬ 
Header("Content-type: image/PNG"); 
$im = imagecreate(60,20); 
$red = ImageColorAllocate($im, 255,255,255); //���ñ�����ɫ 
$white = ImageColorAllocate($im, 0,0,0);//����������ɫ 
$gray = ImageColorAllocate($im, 0,0,0); //�����ӵ���ɫ 

imagefill($im,60,20,$red); 

for ($i = 0; $i < strlen($authnum); $i++) 
{  
imagestring($im, 6, 13*$i+4, 1, substr($authnum,$i,1), $white); 
} 

for($i=0;$i<100;$i++) //����������� 
{ 
imagesetpixel($im, rand()%60 , rand()%20 , $gray); 
} 

ImagePNG($im); //�� PNG ��ʽ��ͼ���������������ļ� 
ImageDestroy($im);//����һͼ�� 

//������������� 
function random($length) { 
$hash = ''; 
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'; 

$max = strlen($chars) - 1; 

for($i = 0; $i < $length; $i++) { 
$hash .= $chars[mt_rand(0, $max)]; 
} 
return $hash; 

} 
?>