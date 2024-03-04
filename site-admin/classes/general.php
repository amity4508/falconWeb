<?php

class general {

    public function uploadfile($files, $path, $options = array()) {
        $uploaded = 0;
        $ext = "";
		$filename = strtolower(basename($files['name']));
        $ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
        $newfilename = rand(100,999) * time();
        if ((!empty($files)) && ($files['error'] == 0)) {
            $filename = strtolower(basename($files['name']));
            $ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
            if ($options['upload'] == 'image') {
                if (isset($options['ext']) && count($options['ext']) > 0) {
                    if (in_array($ext, $options['ext'])) {
                        $ext = "." . $ext;
                        $newname = $path . $newfilename . $ext;
                        if ((@move_uploaded_file($files['tmp_name'], $newname))) {
                            @chmod($newname,0777);
                            return $newfilename . $ext;
                        } else {
                            return false;
                        }
                    }
                }
            } 
            else 
            {
                $ext = "." . $ext;
                $newname = $path . $newfilename . $ext; 
                if ((move_uploaded_file($files['tmp_name'], $newname))) 
                {
                    @chmod($newname,0777);
                    return $newfilename . $ext;
                }
                else 
                {
                    return false;
                }
            }
        }
        else 
        {
            return false;
        }
    }		public function uploadmultiplefile($files,$key, $path, $options = array()) {        $uploaded = 0;        $ext = "";		$filename = strtolower(basename($files['name'][$key]));        $ext = strtolower(substr($filename, strrpos($filename, '.') + 1));        $newfilename = rand(100,999) * time();        if ((!empty($files)) && ($files['error'][$key] == 0)) {            $filename = strtolower(basename($files['name'][$key]));            $ext = strtolower(substr($filename, strrpos($filename, '.') + 1));            if ($options['upload'] == 'image') {                if (isset($options['ext']) && count($options['ext']) > 0) {                    if (in_array($ext, $options['ext'])) {                        $ext = "." . $ext;                        $newname = $path . $newfilename . $ext;                        if ((@move_uploaded_file($files['tmp_name'][$key], $newname))) {                            @chmod($newname,0777);                            return $newfilename . $ext;                        } else {                            return false;                        }                    }                }            }             else             {                $ext = "." . $ext;                $newname = $path . $newfilename . $ext;                if ((move_uploaded_file($files['tmp_name'], $newname)))                 {                    @chmod($newname,0777);                    return $newfilename . $ext;                }                else                 {                    return false;                }            }        }        else         {            return false;        }    }
	
public	function make_thumb($src,$dest,$desired_width = false, $desired_height = false)
{
/*If no dimenstion for thumbnail given, return false */
if (!$desired_height&&!$desired_width) return false;
$fparts = pathinfo($src);
$ext = strtolower($fparts['extension']);
/* if its not an image return false */
if (!in_array($ext,array('gif','jpg','png','jpeg'))) return false;

//print_r($fparts); echo $ext; echo "<br>";//exit;
/* read the source image */
if ($ext == 'gif')
$resource = imagecreatefromgif($src);
else if ($ext == 'png')
$resource = imagecreatefrompng($src);
else if ($ext == 'jpg' || $ext == 'jpeg')
$resource = imagecreatefromjpeg($src);

$width = imagesx($source_image);
$height = imagesy($source_image);
/* find the “desired height” or “desired width” of this thumbnail, relative to each other, if one of them is not given */
if(!$desired_height) $desired_height = floor($height*($desired_width/$width));
if(!$desired_width) $desired_width = floor($width*($desired_height/$height));

/* create a new, “virtual” image */
$virtual_image = imagecreate($desired_width,$desired_height);

/* copy source image at a resized size */ //imagecopyresized  // imagecopyresampled
imagecopyresized($virtual_image,$resource,0,0,0,0,$desired_width,$desired_height,$width,$height);

imagesavealpha($virtual_image, true);
$trans_colour = imagecolorallocatealpha($virtual_image, 0, 0, 0, 127);
imagefill($virtual_image, 0, 0, $trans_colour);


/* create the physical thumbnail image to its destination */
/* Use correct function based on the desired image type from $dest thumbnail source */
$fparts = pathinfo($dest);
$ext = strtolower($fparts['extension']);
/* if dest is not an image type, default to jpg */
if (!in_array($ext,array('gif','jpg','png','jpeg'))) $ext = 'jpg';
$dest = $fparts['dirname'].'/'.$fparts['filename'].'.'.$ext;

if ($ext == 'gif')
imagegif($virtual_image,$dest);
else if ($ext == 'png')
imagepng($virtual_image,$dest,1);
else if ($ext == 'jpg' || $ext == 'jpeg')
imagejpeg($virtual_image,$dest,100);

//imagedestroy($virtual_image);

//print_r($fparts); echo $ext; echo "<br>";exit;


return array(
'width' => $width,
'height' => $height,
'new_width' => $desired_width,
'new_height'=> $desired_height,
'dest' => $dest
);
}

	public function generateThumbs($imagename,$srcpath,$destpath,$desired_width,$desired_height=''){
	
	$fname = $imagename;
	$pathToScreens = $srcpath; // Directory to your images you want converted to thumbnails.
	$pathToThumbs = $destpath; // Directory to your thumbnails.
	$thumbWidth = $desired_width; // Width of the thumbnails generated.
	
	$dir = opendir($pathToScreens);// or die("Could not open directory");
		
	
		if($fname != ""){
	
			$valid_extensions = array("jpg","jpeg","png","gif"); // Only jpeg images allowed.
			$info = pathinfo($pathToScreens . $fname);
			$ext = strtolower(end(explode('.',$fname)));
			
				if(in_array(strtolower($info["extension"]),$valid_extensions)){
					
				
					if ($ext == 'gif'){
						$img = imagecreatefromgif($pathToScreens . $fname); 
					}if ($ext == 'png'){
						$img = imagecreatefrompng($pathToScreens . $fname);
					}if ($ext == 'jpg' || $ext == 'jpeg'){
						$img = imagecreatefromjpeg($pathToScreens . $fname);
					}
										
					$width = imagesx($img);
					$height = imagesy($img);
					// Collect its width and height.
					
					if($desired_height<>""){
						$newHeight = $desired_height;
					}else{
						$newHeight = floor($height * ($thumbWidth / $width)); // Calculate new height for thumbnail.
					}
										
					$tempImage = imagecreatetruecolor($thumbWidth,$newHeight); // Create a temporary image of the thumbnail.
					// Copy and resize old image into new image.
					imagecopyresized($tempImage,$img, 0, 0, 0, 0, $thumbWidth,$newHeight,$width,$height);
					
					if ($ext == 'gif'){
						$genThumb = imagegif($tempImage,$pathToThumbs . $fname); 
					}if ($ext == 'png'){
						$genThumb = imagepng($tempImage,$pathToThumbs . $fname,1);
					}if ($ext == 'jpg' || $ext == 'jpeg'){
						$genThumb = imagejpeg($tempImage,$pathToThumbs . $fname,100);
					}
									
					
				}
		}
	
	}
}

?>
