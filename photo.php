<?php                              

header("Content-type: image/jpeg");  

$file = 'IMG_7154.JPG';
$img = imagecreatefromjpeg($file);
$w = imagesx($img);
$h = imagesy($img);                      
                            
# Get exif information
$exif = exif_read_data($file,null,true,true);


# Get orientation
$orientation = $exif['IFD0']['Orientation'];

# Manipulate image   
switch ($orientation) {
    case 2:
        imageflip($img, IMG_FLIP_HORIZONTAL);
        break;
    case 3:
        $img = imagerotate($img, 180, 0);
        break;
    case 4:
        imageflip($img, IMG_FLIP_VERTICAL);
        break;
    case 5:
        $img = imagerotate($img, -90, 0);
        imageflip($img, IMG_FLIP_HORIZONTAL);
        break;
    case 6:
        $img = imagerotate($img, -90, 0);
        break;
    case 7:
        $img = imagerotate($img, 90, 0);
        imageflip($img, IMG_FLIP_HORIZONTAL);
        break;
    case 8:
        $img = imagerotate($img, 90, 0); 
        break;
}

$trans = imagecolortransparent($img);
if($trans >= 0) {   
	$rgb = imagecolorsforindex($img, $trans);

	$oldimg = $img;
	$img = imagecreatetruecolor($w,$h);
	$color = imagecolorallocate($img,$rgb['red'],$rgb['green'],$rgb['blue']);
	imagefilledrectangle($img,0,0,$w,$h,$color);
	imagecopy($img,$oldimg,0,0,0,0,$w,$h);
}


imagejpeg($img);                                                     

?>