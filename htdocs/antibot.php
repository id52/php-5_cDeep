<?php
include_once("htcore/etc/rc.conf.php");


#$SYS["MYSQL"]["hConnect"] = DB_connect($SYS["MYSQL"]["Server"]["server"], $SYS["MYSQL"]["Server"]["user"], $SYS["MYSQL"]["Server"]["password"]) or die(DB_error('Connect to db_server: ', $DSYS["MYSQL"]["hConnect"]));
#DB_select_db($SYS["MYSQL"]["Server"]["dbname"], $SYS["MYSQL"]["hConnect"]) or die(DB_error('Select database: ', $SYS["MYSQL"]["hConnect"]));


session_start();

define('STEP',10);
define('XS',95);
define('YS',19);
define('S',1.5);

$_SESSION['code'] = rand(1000,9999);

$im = @ImageCreate(XS, 19) or die ("Cannot Initialize new GD image stream");

$background_color = ImageColorAllocate ($im, 255, 255, 255);
$text_color = ImageColorAllocate($im, 00, 0, 0);
$line_color = ImageColorAllocate($im, 100, 100, 100);


ImageSetThickness($im, 1);
ImageRectangle($im,0,0,XS-1,YS-1,$text_color);
for($j=-2; $j<imagesx($im)/STEP+1; $j++){
    //$cur_points_y[] = -rand(0,STEP);
    //$cur_points_x[] = rand($j*STEP+STEP/1.4,$j*STEP+STEP*1.4);
    $last=0;
    for($i=-2; $i<imagesy($im)/STEP+1; $i++)
    {
        $last = STEP*$i+rand(STEP/S,STEP*S);
        $cur_points_y[] = $last;
        $cur_points_x[] = rand($j*STEP+STEP/S,$j*STEP+STEP*S);
    }
    $cur_points_y[] = YS;
    $cur_points_x[] = rand($j*STEP+STEP/S,$j*STEP+STEP*S);
    for($i=1; $i<5; $i++)
    {
        /*
        ImageLine($im,$prev_points_x[$i], $prev_points_y[$i], $cur_points_x[$i], $cur_points_y[$i], $line_color);
        ImageLine($im,$prev_points_x[$i-1], $prev_points_y[$i-1], $cur_points_x[$i], $cur_points_y[$i], $line_color);
        ImageLine($im,$prev_points_x[$i], $prev_points_y[$i], $cur_points_x[$i-1], $cur_points_y[$i-1], $line_color);
        */
    }
    unset($prev_points_x);
    unset($prev_points_y);
    $prev_points_x = $cur_points_x;
    $prev_points_y = $cur_points_y;
    unset($cur_points_x);
    unset($cur_points_y);
}

$num = (string)$_SESSION['code'];

for($i = 0; $i < strlen($num); $i++)
{
    $cipher = substr($num, $i, 1);
    $psize = rand(8,10);
    $angle = rand(0,2);
#    $sizes = ImageTTFBBox($psize, $angle, "arbat.ttf", $cipher);
    $width = $sizes[2]-$sizes[0];
    $height = $sizes[1]-$sizes[7];
    $dh = (14-$height)/2;
    $px = (imagesx($im)/strlen($num))*$i+(imagesx($im)/strlen($num)-$width)/2;
    $py = ($height+$dh+1)+rand(-$dh+10, $dh-10);
#    ImageTTFText ($im, $psize, $angle, $px, $py, $text_color, "./arbat.ttf", $cipher);
    ImageString ($im, $psize, $px, $py-10, $cipher, 2);
}


ob_start();
ImageGif($im);
$content=ob_get_contents();
ob_end_flush();

@Header("Accept-ranges: bytes");
@Header("Content-length: ".strlen($content));
@Header("Content-type: image/png");
echo $content;
?>