<?php 

function imagefillroundedrect($im,$x,$y,$cx,$cy,$rad,$col)
{

// Draw the middle cross shape of the rectangle

    imagefilledrectangle($im,$x,$y+$rad,$cx,$cy-$rad,$col);
    imagefilledrectangle($im,$x+$rad,$y,$cx-$rad,$cy,$col);

    $dia = $rad*2;

// Now fill in the rounded corners

    imagefilledellipse($im, $x+$rad, $y+$rad, $rad*2, $dia, $col);
    imagefilledellipse($im, $x+$rad, $cy-$rad, $rad*2, $dia, $col);
    imagefilledellipse($im, $cx-$rad, $cy-$rad, $rad*2, $dia, $col);
    imagefilledellipse($im, $cx-$rad, $y+$rad, $rad*2, $dia, $col);
	return $im;
}
function imageRoundedCopyResampled(&$dstimg, &$srcimg, $dstx, $dsty, $srcx,
                                   $srcy, $dstw, $dsth, $srcw, $srch, $radius) {
    # Resize the Source Image
    $srcResized = imagecreatetruecolor($dstw, $dsth);
    imagecopyresampled($srcResized, $srcimg, 0, 0, $srcx, $srcy,
                       $dstw, $dsth, $srcw, $srch);
    # Copy the Body without corners
    imagecopy($dstimg, $srcResized, $dstx+$radius, $dsty,
              $radius, 0, $dstw-($radius*2), $dsth);
    imagecopy($dstimg, $srcResized, $dstx, $dsty+$radius,
              0, $radius, $dstw, $dsth-($radius*2));
    # Create a list of iterations; array(array(X1, X2, CenterX, CenterY), ...)
    # Iterations in order are: Top-Left, Top-Right, Bottom-Left, Bottom-Right
    $iterations = array(
        array(0, 0, $radius, $radius),
        array($dstw-$radius, 0, $dstw-$radius, $radius),
        array(0, $dsth-$radius, $radius, $dsth-$radius),
        array($dstw-$radius, $dsth-$radius, $dstw-$radius, $dsth-$radius)
    );
    # Loop through each corner 'iteration'
    foreach($iterations as $iteration) {
        list($x1,$y1,$cx,$cy) = $iteration;
        for ($y=$y1; $y<=$y1+$radius; $y++) {
            for ($x=$x1; $x<=$x1+$radius; $x++) {
                # If length (X,Y)->(CX,CY) is less then radius draw the point
                $length = sqrt(pow(($cx - $x), 2) + pow(($cy - $y), 2));
                if ($length < $radius) {
                    imagecopy($dstimg, $srcResized, $x+$dstx, $y+$dsty,
                              $x, $y, 1, 1);
                }
            }
        }
    }
	imagejpeg($dstimg,"images/test.jpg",100);
}

//if($ext[1]=='gif' || $ext[1]=='GIF'){
		//$src = imagecreatefromgif($uploadedfile);
	//}
	//else{
	$uploadedfile = "images/20080711070342DSC00492.jpg";
		$src = imagecreatefromjpeg($uploadedfile);
	//}
	
	list($width,$height)=getimagesize($uploadedfile);
	
	$mini_size = 150;
	if($height<$width){
		$newwidth=$mini_size;
		$newheight=($height/$width)*$mini_size;
	}
	else{
		$newwidth=($width/$height)*$mini_size;
		$newheight=$mini_size;
	}
	
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	//$myBlack = imagecolorallocate($src,0,0,0);
	//$tmp = imagefillroundedrect($tmp,0,0,$newwidth,$newheight,10,$myBlack);
	// this line actually does the image resizing, copying from the original
	// image into the $tmp image
	//imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	
	$tmp = imageRoundedCopyResampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height, 30);
	// now write the resized image to disk. I have assumed that you want the
	// resized, uploaded image file to reside in the ./images subdirectory.
	$filename = "images/test.jpg";
	
	
	//if($ext[1]=='gif' || $ext[1]=='GIF')
//		imagegif($tmp,$filename,100);
//	else
	/*	imagejpeg($tmp,$filename,100);
		
	imagedestroy($src);
	imagedestroy($tmp);*/
	echo "<img src='$filename' />";
?> 