<?php
function full_del_dir ($deldir)
{
		  $dir = opendir($deldir);
		  while(($file = readdir($dir)))
		  {
			if ( is_file ($deldir."/".$file))
			{
			  unlink ($deldir."/".$file);
			}
			else
				if ( is_dir ($deldir."/".$file) &&	($file != ".") && ($file != ".."))
				{
					full_del_dir ($deldir."/".$file);
				}
		  };
		  closedir ($dir);
		  rmdir ($deldir);
};
//$deldir = "htcore/tmp/img/";
//full_del_dir ($deldir);

$path=realpath(dirname(__FILE__).'/htcore/').'/';
if(is_dir($path))
	define('ROOT', realpath(dirname(__FILE__).'/htcore/').'/');
	


	
function __autoload($class)
{
  $class_file = str_replace('_', '/', $class);
  
  if ( file_exists(ROOT.'lib/'.$class_file.'.lib.php') || file_exists(ROOT.'libs/'.$class_file.'.lib.php'))
  {
  
	if ( file_exists(ROOT.'lib/'.$class_file.'.lib.php') )
	{
		include_once(ROOT.'lib/'.$class_file.'.lib.php');
	}
	if ( file_exists(ROOT.'libs/'.$class_file.'.lib.php') )
	{
		include_once(ROOT.'libs/'.$class_file.'.lib.php');
	}
  }
  else
  {
    //die('Failed load class ['.$class.'] in /lib/'.$class_file.'.lib.php');
	$failedLoadClass=true;
  }
}

if($failedLoadClass)
{
	$cDeep            = new cDeep();
	$cDeep->obj['DB']       = DbSimple_Generic::connect($cDeep->DSN);
	$cDeep->obj['DB']->setErrorHandler('databaseErrorHandler');
	function databaseErrorHandler($message, $info)
	{
	  if (!error_reporting()) return;
	  echo "SQL Error: $message<br><pre>";
	  print_r($info);
	  echo "</pre>";
	}
	$cDeep->obj['DB']->query("set character_set_results='utf8'");
	$cDeep->obj['DB']->query("set character_set_client='utf8'");
	$cDeep->obj['DB']->query("set collation_connection='utf8_general_ci'");
	$cDeep->obj['DB']->query("set collation_server='utf8_general_ci'");
	$cDeep->obj['DB']->query("set collation_database='utf8_general_ci'");

$tableexists=$cDeep->obj['DB']->query("SELECT * FROM information_schema.tables WHERE table_name = 'imagesettings' LIMIT 1 ");
};

if(!empty($tableexists))
{
	$imagesettings=$cDeep->obj['DB']->selectRow("select * from `imagesettings`");
	$quality=floatval($imagesettings['quality']);
}
else
{
	$quality=floatval(90);
};

/////////////////////////////////////////////////////////////////////////////////////////////////////////

$ext = function_exists('imagecopyresized')?'GD':$ext; 		//GD enabled
$ext = function_exists('NewMagickWand')?'MagickWand':$ext;	//MagickWand enabled
//$ext='GD';
$w=floatval($_GET['w']);
$h=floatval($_GET['h']);

$path=$_GET['path'];
$type=$_GET['type'];
$color="#".$_GET['color'];

if($_GET['transparent'])
	$color="#ffffffff";

$pathmas=split("/",$path);
for($i=0;$i<count($pathmas)-1;$i++)
  $pathdir=$pathdir.$pathmas[$i].'/';

function zoom4()
{
	global $path, $w, $h, $type, $color, $img, $quality;
    $pixel= NewMagickWand();
    $img = NewMagickWand();
    MagickReadImage( $img, $path );
	
	if($w==0 && $h!=0) $w=MagickGetImageWidth( $img );
	if($w!=0 && $h==0) $h=MagickGetImageHeight( $img );

	$ww=MagickGetImageWidth( $img );
	$hh=MagickGetImageHeight( $img );
		
		$wE = $ww/$w;
		$hE = $hh/$h;
		$e = ($wE < $hE)?$wE:$hE;


	$nw=$ww/$e;
	$nh=$hh/$e;

	if($wE>$hE)
	{
		MagickResizeImage($img, $nw,$nh, MW_BesselFilter, 1);
		MagickCropImage($img,$nw ,$nh , ($nw-$w)/2,0  ) ;
		MagickCropImage($img,0 ,0 , -($nw-$w)/2,0  ) ;
		MagickResizeImage($img, $w,$h, MW_BesselFilter, 1);
	}
	else
	{
		MagickResizeImage($img, $nw,$nh, MW_BesselFilter, 1);
		MagickCropImage($img,$nw, $nh, 0,($nh-$h)/2) ;
		MagickCropImage($img,0 ,0 , 0,-($nh-$h)/2) ;
		MagickResizeImage($img, $w,$h, MW_BesselFilter, 1);
	};
	
	MagickSetImageCompressionQuality($img, $quality);
	header('Content-Type: image/jpeg');
    MagickEchoImageBlob( $img );
	DestroyMagickWand($img);
	DestroyMagickWand($pixel);

	
};


function zoomg4()
{
		global $path, $w, $h, $type, $color, $img, $quality, $imagecreate;
		$img=$imagecreate($path);
		
		if($w==0 && $h!=0) $w=imagesx($img);
		if($w!=0 && $h==0) $h=imagesy($img);

		$ww=imagesx($img );
		$hh=imagesy($img);
		
		$wE = $ww/$w;
		$hE = $hh/$h;
		$e = ($wE < $hE)?$wE:$hE;

		$nw=$ww/$e;
		$nh=$hh/$e;
		
		$dx=$nw-$w;
		$dy=$nh-$h;
		
		
		if($wE>$hE)
		{
			$img1=imagecreatetruecolor($nw,$nh);
			imagecopyresized($img1, $img,0, 0,0, 0,$nw,$nh,imagesx($img),imagesy($img));
			$img2=imagecreatetruecolor($w,$h);
			imagecopyresized($img2, $img1, 0,0,$dx/2,0, $w,$h,$w,$h);
		}
		else
		{
			$img1=imagecreatetruecolor($nw,$nh);
			imagecopyresized($img1, $img,0,0,0,0,$nw,$nh,imagesx($img),imagesy($img));
			$img2=imagecreatetruecolor($w,$h);
			imagecopyresized($img2, $img1, 0,0,0,$dy/2, $w,$h,$w,$h);
			
		};


	//http://php.net/manual/en/function.imagefilter.php
	imagefilter($canvas, IMG_FILTER_GAUSSIAN_BLUR);
	imagefilter($canvas, IMG_FILTER_SELECTIVE_BLUR);


		
	header('Content-Type: image/jpeg');
	imagejpeg($img2,null,$quality);
	
	imagedestroy($img2);
	imagedestroy($img1);
	imagedestroy($img);
	
	
};


function zoom5()
{     
  global $path, $w, $h, $type, $color, $img, $quality;

  $img = NewMagickWand();
  MagickReadImage( $img, $path );

  if($w==0 && $h!=0) $w=MagickGetImageWidth( $img );
  if($w!=0 && $h==0) $h=MagickGetImageHeight( $img );
	
  $dw=MagickGetImageWidth($img)-$w;
  $dh=MagickGetImageHeight($img)-$h;
  
  MagickCropImage($img,MagickGetImageWidth($img),0,-$dw/2,0);  
  MagickCropImage($img,0,0,$dw/2,0);  
  
  MagickCropImage($img,0,MagickGetImageHeight($img),0,-$dh/2);  
  MagickCropImage($img,0,0,0,$dh/2);  

  MagickResizeImage($img, $w,$h, MW_BesselFilter, 1);
  
  MagickSetImageCompressionQuality($img, $quality);
  header('Content-Type: image/jpeg');
  MagickEchoImageBlob( $img );
  DestroyMagickWand($img);

}

function zoomg5()
{     
	global $path, $w, $h, $type, $color, $img, $quality, $imagecreate;
	$img=$imagecreate($path);

  if($w==0 && $h!=0) $w=imagesx($img);
  if($w!=0 && $h==0) $h=imagesy($img);
	
  $dw=imagesx($img)-$w;
  $dh=imagesy($img)-$h;
  
  
  $img1 = imagecreatetruecolor($w,$h);
  imagecopyresized($img1, $img,0, 0, $dw/2, $dh/2,$w,$h,imagesx($img)-$dw,imagesy($img)-$dh);
  
  //http://php.net/manual/en/function.imagefilter.php
	imagefilter($canvas, IMG_FILTER_GAUSSIAN_BLUR);
	imagefilter($canvas, IMG_FILTER_SELECTIVE_BLUR);
  
  
	header('Content-Type: image/jpeg');
	imagejpeg($img1,null,$quality);

	imagedestroy($img1);
	imagedestroy($img);

	
};

function zoomg()
{

	global $path, $w, $h, $type, $color, $img, $quality, $imagecreate;
	$img=$imagecreate($path);
	
	
	$w=floatval($w);
    $h=floatval($h);
            
    if($w==0 && $h!=0) $w=imagesx( $img );
    if($w!=0 && $h==0) $h=imagesy( $img );
         
		if(
			$w > imagesx( $img ) &&
			$h > imagesy( $img )
		)
		{
			return false;
		};
		
				if($w==0)
                    $wE=1;
                else
                    $wE = imagesx( $img )/$w;
                
                if($h==0)
                    $hE=1;
                else
                    $hE = imagesy( $img )/$h;

		$e = ($wE > $hE)?$wE:$hE;
		
		$w1 = imagesx($img)/$e;
		$h1 = imagesy($img)/$e;
		
		$canvas = imagecreatetruecolor($w1,$h1);
		imagecopyresized($canvas, $img, 0, 0, 0, 0, $w1, $h1, imagesx($img), imagesy($img));
		
	//http://php.net/manual/en/function.imagefilter.php
	imagefilter($canvas, IMG_FILTER_GAUSSIAN_BLUR);
	imagefilter($canvas, IMG_FILTER_SELECTIVE_BLUR);
	
	
	
	header('Content-Type: image/jpeg');
    imagejpeg($canvas,null,$quality);
	
	imagedestroy($canvas);
	imagedestroy($img);
    

};

function zoom()
{     
    global $path, $w, $h, $type, $color, $img, $quality;
    $img = NewMagickWand();
    MagickReadImage($img, $path);
	
    //////////////////////
    
    $w=floatval($w);
    $h=floatval($h);
            
    if($w==0 && $h!=0) $w=MagickGetImageWidth( $img );
    if($w!=0 && $h==0) $h=MagickGetImageHeight( $img );
                
		if(
			$w > MagickGetImageWidth( $img ) &&
			$h > MagickGetImageHeight( $img )
		)
		{
			header('Content-Type: image/jpeg');
			MagickEchoImageBlob( $img );
			DestroyMagickWand($img);
			//return false;
		}
                
                if($w==0)
                    $wE=1;
                else
                    $wE = MagickGetImageWidth( $img )/$w;
                
                if($h==0)
                    $hE=1;
                else
                    $hE = MagickGetImageHeight( $img )/$h;

		$e = ($wE > $hE)?$wE:$hE;

		$w1 = MagickGetImageWidth($img)/$e;
		$h1 = MagickGetImageHeight($img)/$e;
   
  MagickResizeImage($img, $w1,$h1, MW_BesselFilter, 1);
  MagickSetImageCompressionQuality($img, $quality);
  header('Content-Type: image/jpeg');
  MagickEchoImageBlob( $img );
  DestroyMagickWand($img);
    
  
  
  
  

}


function htmlcolor($img,$color) 
{
    sscanf($color, "%2x%2x%2x", $red, $green, $blue);
    return ImageColorAllocate($img,$red,$green,$blue);
    return($c);
};


function zoom3()
{
    global $path, $w, $h, $type, $color, $img, $quality;
	
	$alpha = substr($color, 7, 2);
	$color = substr($color, 0, 7);

    $pixel= NewMagickWand();
	if($alpha)
		MagickReadImage( $pixel, 'images/root/1px.png' );
	else
		MagickReadImage( $pixel, 'images/root/1px.jpg' );
    $img = NewMagickWand();
    MagickReadImage( $img, $path );
    if($w==0 && $h!=0) MagickResizeImage($pixel, MagickGetImageWidth( $img ),$h, MW_BesselFilter, 1);
    if($w!=0 && $h==0) MagickResizeImage($pixel, $w, MagickGetImageHeight( $img ), MW_BesselFilter, 1);
    if($w!=0 && $h!=0) MagickResizeImage($pixel, $w, $h, MW_BesselFilter, 1);
    MagickResizeImage($pixel, $w,$h, MW_BesselFilter, 1);
    MagickColorizeImage($pixel,$color,'#ffffff'.$alpha);
	
        if($w==0) $wE=1;
        else      $wE = MagickGetImageWidth( $img )/$w;
        
        if($h==0) $hE=1;
        else      $hE = MagickGetImageHeight( $img )/$h;
        
        $e = ($wE >= $hE)?$wE:$hE;
    
                
    MagickResizeImage($img, MagickGetImageWidth( $img )/$e,MagickGetImageHeight( $img )/$e, MW_BesselFilter, 1);

    if ($w==0 && $h==0)
        MagickCompositeImage($pixel,$img,MW_OverCompositeOp,MagickGetImageWidth( $img ),MagickGetImageHeight( $img ));
    
    if ($w==0 && $h!=0)
        MagickCompositeImage($pixel,$img,MW_OverCompositeOp,(MagickGetImageWidth( $pixel )-MagickGetImageWidth( $img ))/2,($h-MagickGetImageHeight( $img ))/2);
    
    if ($w!=0 && $h==0)
        MagickCompositeImage($pixel,$img,MW_OverCompositeOp,($w-MagickGetImageWidth( $img ))/2,(MagickGetImageHeight( $pixel )-MagickGetImageHeight( $img ))/2);
    
    if($w!=0 && $h!=0)
        MagickCompositeImage($pixel,$img,MW_OverCompositeOp,($w-MagickGetImageWidth( $img ))/2,($h-MagickGetImageHeight( $img ))/2);
    
	MagickSetImageCompressionQuality($pixel, $quality);
	header('Content-Type: image/png');
	MagickEchoImageBlob($pixel);
	
	DestroyMagickWand($img);
	DestroyMagickWand($pixel);

};


function zoomg3()
{
    global $path, $w, $h, $type, $color, $img, $quality, $imagecreate;

	$alpha = substr($color, 7, 2);
	$color = substr($color, 1, 7);
	
	$img=$imagecreate($path);
	
	$w=floatval($w);
    $h=floatval($h);
            
    if($w==0 && $h!=0) $w=imagesx($img);
    if($w!=0 && $h==0) $h=imagesy($img);

	if($w==0) $wE=1;
    else      $wE = imagesx($img)/$w;
        
    if($h==0) $hE=1;
    else      $hE = imagesy($img)/$h;
        
    $e = ($wE >= $hE)?$wE:$hE;	
	
	$newimg = imagecreatetruecolor(imagesx($img)/$e,imagesy($img)/$e);
	
	//$alpha="0x".$alpha.
	$canvas = imagecreatetruecolor($w,$h);

	$color=htmlcolor($img,$color);
	imagefill ($canvas, 0, 0, $color );
	imageCopyResampled($canvas, $img, (imagesx($canvas)-imagesx($newimg))/2, (imagesy($canvas)-imagesy($newimg))/2, 0, 0, imagesx($newimg), imagesy($newimg), imagesx($newimg)*$e, imagesy($newimg)*$e);
	
	//imagecolortransparent($canvas, imagecolorallocatealpha($canvas, 0, 0, 0, $alpha));
    //imagealphablending($canvas, false);
    //imagesavealpha($canvas, true);

	header('Content-Type: image/jpeg');
	imagejpeg($canvas,null,$quality);
	
	imagedestroy($canvas);
	imagedestroy($newimg);

	
	
};


/********************************************************************************/
global $cFile,$alpha,$ext;
if(!is_dir('htcore/tmp/img/'.$w.'x'.$h.'/'.$pathdir)) 
	mkdir('htcore/tmp/img/'.$w.'x'.$h.'/'.$pathdir, 0777, 1); 	

$hash=md5($path.$ext.$w.$h.$type.$color.$quality);
$cFile = 'htcore/tmp/img/'.$w.'x'.$h.'/'.$pathdir.'/'.$type.'-'.$w.'x'.$h.$color.'-'.$quality.'-'.$ext.'-'.$hash;


	if(file_exists($cFile))
	{
		$alpha = substr($color, 7, 2);
		if(!$alpha)	header('Content-Type: image/jpeg');
		else		header('Content-Type: image/png');
		print file_get_contents($cFile);
	}
	else
	
	{
		ob_start();	
		//$ext="GD";
		switch($ext)
		{
			case 'GD':
			{
					$hImageInfo = getimagesize($path);
					$format = $hImageInfo[2];
					switch ($format)
					{
							case 1: //GIF
							$imagecreate="imagecreatefromgif";break;
							case 2: //JPG
							$imagecreate="imagecreatefromjpeg";break;
							case 3: //PNG
							$imagecreate="imagecreatefrompng";break;
							case 4: //SWF
							$imagecreate= "imagecreatefromgd";break;
							case 5: //PSD
							$imagecreate= "imagecreatefromgd";break;
							case 6: //BMP
							$imagecreate= "imagecreatefromwbmp";break;
							case 7: //TIFF(intel)
							$imagecreate="imagecreatefromgd";break;
							case 8: //TIFF(motorola)
							$imagecreate="imagecreatefromgd";break;
							case 9: //JPC
							$imagecreate="imagecreatefromgd";break;
							case 10: //JP2
							$imagecreate="imagecreatefromgd";break;
							case 11: //JPX
							$imagecreate="imagecreatefromgd";break;

					};
					

			
				switch($type)
				{
					case 'preview':zoomg();break;
					case 'zoom':zoomg();break;
					case 'zoom3':zoomg3();break;
					case 'zoom4':zoomg4();break;
					case 'zoom5':zoomg5();break;
					default:zoomg();break;
				};
				break;
			};
			case 'MagickWand':
			{
				switch($type)
				{
					case 'preview':zoom();break;
					case 'zoom':zoom();break;
					case 'zoom3':zoom3();break;
					case 'zoom4':zoom4();break;
					case 'zoom5':zoom5();break;
					default:zoom();break;
				};
				break;
			};
			default:break;
		};	
		$content = ob_get_contents();
		file_put_contents($cFile, $content);
	};

?>