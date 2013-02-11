<?
class Image
{
	var $extension;
	var $ImageSource;
	var $data;


	public function __construct()
	{
		$this->prefix = '.';
		$ext = null;
		$ext = function_exists('imagecopyresized')?'GD':$ext; 		//GD enabled
		$ext = function_exists('NewMagickWand')?'MagickWand':$ext;	//MagickWand enabled

		$this->extension = $ext;
		if (empty($this->extension))
		{
			$this->exception(E_ERROR);
		}
	}

	private function exception($E_LEVEL)
	{
		exit;
	}

	public function open($ImageFile)
	{
		if (!file_exists($ImageFile))
		{
			$this->exception(E_ERROR);
		}

		switch ($this->extension)                {
			case 'GD':

				if (!file_exists($ImageFile))
				{
					$this->exception(E_ERROR);
				}

				$hImageInfo = getimagesize($ImageFile);
				$this->ImageSource["Bits"] = $hImageInfo["bits"];
				$this->ImageSource["Width"] = $hImageInfo[0];
				$this->ImageSource["Height"] = $hImageInfo[1];
				$this->ImageSource["Channels"] = $hImageInfo["channels"];
				$this->ImageSource["Mime"] = $hImageInfo["mime"];
				$this->ImageSource["Type"] = $hImageInfo[2];
				$this->ImageSource['Src'] = $ImageFile;
				$this->ImageSource['Etag'] = md5($ImageFile);

				switch ($hImageInfo["2"])
				{
					case 1: //GIF
					$this->ImageSource["stream"] = imagecreatefromgif($ImageFile);
					imagecolortransparent($this->ImageSource["stream"]);
					$this->ImageSource["FileType"] = "gif";
					break;
					case 2: //JPG
					$this->ImageSource["stream"] = imagecreatefromjpeg($ImageFile);
					$this->ImageSource["FileType"] = "jpg";
					break;
					case 3: //PNG
					$this->ImageSource["stream"] = imagecreatefrompng($ImageFile);
					break;
					case 4: //SWF
					$this->ImageSource["stream"] = imagecreatefromgd($ImageFile);
					break;
					case 5: //PSD
					$this->ImageSource["stream"] = imagecreatefromgd($ImageFile);
					break;
					case 6: //BMP
					$this->ImageSource["stream"] = imagecreatefromwbmp($ImageFile);
					break;
					case 7: //TIFF(intel)
					$this->ImageSource["stream"] = imagecreatefromgd($ImageFile);
					break;
					case 8: //TIFF(motorola)
					$this->ImageSource["stream"] = imagecreatefromgd($ImageFile);
					break;
					case 9: //JPC
					$this->ImageSource["stream"] = imagecreatefromgd($ImageFile);
					break;
					case 10: //JP2
					$this->ImageSource["stream"] = imagecreatefromgd($ImageFile);
					break;
					case 11: //JPX
					$this->ImageSource["stream"] = imagecreatefromgd($ImageFile);
					break;
				}

				if(gettype($this->ImageSource["stream"])=="resource") // succesfully opened
				{
					return true;
				}
				return false;
				break;

			case 'MagickWand':
				$this->ImageSource["stream"] = NewMagickWand();
                            

				if (MagickReadImage($this->ImageSource["stream"], $ImageFile)) {

					$this->ImageSource["Bits"] = MagickGetImageColors($this->ImageSource["stream"]);
					$this->ImageSource["Width"] = MagickGetImageWidth($this->ImageSource["stream"]);
					$this->ImageSource["Height"] = MagickGetImageHeight($this->ImageSource["stream"]);
					$this->ImageSource["Channels"] = MagickGetImageColors($this->ImageSource["stream"]);
					$this->ImageSource["Mime"] = 'image/'.strtolower(MagickGetImageFormat($this->ImageSource["stream"]));
					//MagickGetMimeType($this->ImageSource["stream"]);
					$this->ImageSource["Type"] = MagickGetImageType($this->ImageSource["stream"]);
                                        
					return true;
				}
				return false;
				break;

			default:
				break;
		}
		return false;
	}

	public function crop($x, $y, $w, $h)
	{
		$x = intval($x);
		$y = intval($y);
		$w = floatval($w);
		$h = floatval($h);

		if(
		$x > $this->ImageSource["Width"] ||
		$y > $this->ImageSource["Height"] ||
		($w + $x) > $this->ImageSource["Width"]||
		($h + $y) > $this->ImageSource["Height"]
		)
		{
			return false;
		}
		
		switch ($this->extension) {
			case 'MagickWand':
				if (MagickCropImage($this->ImageSource['stream'], $w, $h, $x, $y )) {
					$this->ImageSource["Width"] = $w;
					$this->ImageSource["Height"] = $h;
					return true;
				}
				break;
			case 'GD':
				$canvas = imagecreatetruecolor($w,$h);
				if (imagecopy($canvas, $this->ImageSource['stream'], 0, 0, $x, $y, $w, $h))
				{
					$this->ImageSource['stream'] = $canvas;
					$this->ImageSource["Width"] = $w;
					$this->ImageSource["Height"] = $h;
					return true;
				}
				break;

			default:
				break;
		}
		return false;
	}

	public function resize($w, $h)
	{
                        
		$w = floatval($w);
		$h = floatval($h);
                
		switch ($this->extension) {
			case 'MagickWand':
				if (MagickResizeImage($this->ImageSource['stream'], $w, $h, MW_TriangleFilter, 1)) {
                                        
                                        $this->ImageSource["Width"] = $w;
                                    	$this->ImageSource["Height"] = $h;
					return true;
				}
				break;
			case 'GD':
				$canvas = imagecreatetruecolor($w,$h);
				if (imagecopyresized($canvas, $this->ImageSource['stream'], 0, 0, 0, 0, $w, $h, $this->ImageSource["Width"], $this->ImageSource["Height"]))
				{
					$this->ImageSource['stream'] = $canvas;
					$this->ImageSource["Width"] = $w;
					$this->ImageSource["Height"] = $h;
					return true;
				}
				break;

			default:
				break;
		}
		return false;
	}

	public function GetCache($tag)
	{
		if(file_exists($this->prefix.'/'.$tag))
		{
			$this->data = file_get_contents($this->prefix.'/'.$tag);
			return true;
		}
		return false;
	}

	public function SaveCache($tag)
	{
		$file = fopen($this->prefix.'/'.$tag, "w");
		fwrite($file, $this->data);
		fclose($file);
		return true;
	}

	public function preview($w, $h)
	{
		if(
		$w > $this->ImageSource["Width"] &&
		$h > $this->ImageSource["Height"]
		)
		{
			return false;
		}
		$wE = $this->ImageSource["Width"]/$w;
		$hE = $this->ImageSource["Height"]/$h;
		$e = ($wE < $hE)?$wE:$hE;
		$x = ($this->ImageSource["Width"] - $w*$e)/2;
		$y = ($this->ImageSource["Height"] - $h*$e)/2;
		$this->crop($x,$y,$w*$e,$h*$e);
		$this->scale(1/$e);
	}
	
	public function limit($w, $h)
	{
            $w=floatval($w);
            $h=floatval($h);
            
		if(
		$w > $this->ImageSource["Width"] &&
		$h > $this->ImageSource["Height"]
		)
		{
			return false;
		}
                
                if($w==0)
                    $wE=1;
                else
                    $wE = $this->ImageSource["Width"]/$w;
                
                if($h==0)
                    $hE=1;
                else
                    $hE = $this->ImageSource["Height"]/$h;
                //DrawCircle($this->ImageSource['stream'],20,20,40,40);
		$e = ($wE > $hE)?$wE:$hE;
    		$this->scale(1/$e);
	}
        
        
        public function limit2($w, $h)
	{
		if(
		$w > $this->ImageSource["Width"] &&
		$h > $this->ImageSource["Height"]
		)
		{
			return false;
		}
		$wE = $this->ImageSource["Width"]/$w;
		$hE = $this->ImageSource["Height"]/$h;
		
		$this->scale2(1/$wE, 1/$hE);
	}
        
        

        

	public function scale($e)
	{
		$w = $this->ImageSource["Width"]*$e;
		$h = $this->ImageSource["Height"]*$e;
   $this->resize($w, $h);
	}
        
        
public function scale2($wE,$hE)
	{
		//$w = $this->ImageSource["Width"]*$e;
		//$h = $this->ImageSource["Height"]*$e;
               //
        $w = $this->ImageSource["Width"]*$wE;
		$h = $this->ImageSource["Height"]*$hE;
        $this->resize($w, $h);
	}

	public function render($type='', $file=null)
	{
		$type = $this->ImageSource["Type"];
		ob_start();
		switch ($this->extension) {
			case 'MagickWand':
				switch ($type) {
					case 'GIF':
						MagickSetImageFormat($this->ImageSource['stream'], 'GIF');
						break;

					case 'PNG':
						MagickSetImageFormat($this->ImageSource['stream'], 'PNG');
						break;

					case 'JPEG':
					default:
                                                
						MagickSetImageFormat($this->ImageSource['stream'], 'JPEG');
						break;
				}
				if (empty($file))
				{
					MagickEchoImageBlob($this->ImageSource['stream']);
				}
				else
				{
					MagickWriteImage($this->ImageSource['stream'], $file);
				}
				break;
			case 'GD':
				switch ($type) {
					case 1: //GIF
					imagegif($this->ImageSource['stream'], $file);
					break;
					case 3: //PNG
					imagepng($this->ImageSource['stream'], $file);
					break;

					case 2: //JPG
					case 4: //SWF
					case 5: //PSD
					case 6: //BMP
					case 7: //TIFF(intel)
					case 8: //TIFF(motorola)
					case 9: //JPC
					case 10: //JP2
					case 11: //JPX

					imagejpeg($this->ImageSource['stream'], $file);
					break;
				}
				break;
			default:
				break;
		}
		$this->data = ob_get_clean();
	}
}
?>
