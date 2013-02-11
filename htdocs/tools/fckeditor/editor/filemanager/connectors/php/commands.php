<?php
/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2008 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * This is the File Manager Connector for PHP.
 */


function GetFolders( $resourceType, $currentFolder )
{
	// Map the virtual path to the local server path.
	$sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'GetFolders' ) ;

	// Array that will hold the folders names.
	$aFolders	= array() ;

	$oCurrentFolder = opendir( $sServerDir ) ;

	while ( $sFile = readdir( $oCurrentFolder ) )
	{
		if ( $sFile != '.' && $sFile != '..' && is_dir( $sServerDir . $sFile ) )
			$aFolders[] = '<Folder name="' . ConvertToXmlAttribute( $sFile ) . '" />' ;
	}

	closedir( $oCurrentFolder ) ;

	// Open the "Folders" node.
	echo "<Folders>" ;

	natcasesort( $aFolders ) ;
	foreach ( $aFolders as $sFolder )
		echo $sFolder ;

	// Close the "Folders" node.
	echo "</Folders>" ;
}

function GetFoldersAndFiles( $resourceType, $currentFolder )
{
	// Map the virtual path to the local server path.
	$sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'GetFoldersAndFiles' ) ;

	// Arrays that will hold the folders and files names.
	$aFolders	= array() ;
	$aFiles		= array() ;

	$oCurrentFolder = opendir( $sServerDir ) ;

	while ( $sFile = readdir( $oCurrentFolder ) )
	{
		if ( $sFile != '.' && $sFile != '..' )
		{
			if ( is_dir( $sServerDir . $sFile ) )
				$aFolders[] = '<Folder name="' . ConvertToXmlAttribute( $sFile ) . '" size="'. filemanager_dirsize($sServerDir.$sFile) .'"/>' ;
			else
			{
				$iFileSize = @filesize( $sServerDir . $sFile ) ;
				if ( !$iFileSize ) {
					$iFileSize = 0 ;
				}
				if ( $iFileSize > 0 )
				{
					$iFileSize = round( $iFileSize / 1024 ) ;
					if ( $iFileSize < 1 ) $iFileSize = 1 ;
				}

				$aFiles[] = '<File name="' . ConvertToXmlAttribute( $sFile ) . '" size="' . $iFileSize . '" />' ;
			}
		}
	}

	// Send the folders
	natcasesort( $aFolders ) ;
	echo '<Folders>' ;

	foreach ( $aFolders as $sFolder )
		echo $sFolder ;

	echo '</Folders>' ;

	// Send the files
	natcasesort( $aFiles ) ;
	echo '<Files>' ;

	foreach ( $aFiles as $sFiles )
		echo $sFiles ;

	echo '</Files>' ;
}

function CreateFolder( $resourceType, $currentFolder )
{
	if (!isset($_GET)) {
		global $_GET;
	}
	$sErrorNumber	= '0' ;
	$sErrorMsg		= '' ;

	if ( isset( $_GET['NewFolderName'] ) )
	{
		$sNewFolderName = filemanager_translit($_GET['NewFolderName']) ;
		$sNewFolderName = SanitizeFolderName( $sNewFolderName ) ;

		if ( strpos( $sNewFolderName, '..' ) !== FALSE )
			$sErrorNumber = '102' ;		// Invalid folder name.
		else
		{
			// Map the virtual path to the local server path of the current folder.
			$sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'CreateFolder' ) ;

			if ( is_writable( $sServerDir ) )
			{
				$sServerDir .= $sNewFolderName ;

				$sErrorMsg = CreateServerFolder( $sServerDir ) ;

				switch ( $sErrorMsg )
				{
					case '' :
						$sErrorNumber = '0' ;
						break ;
					case 'Invalid argument' :
					case 'No such file or directory' :
						$sErrorNumber = '102' ;		// Path too long.
						break ;
					default :
						$sErrorNumber = '110' ;
						break ;
				}
			}
			else
				$sErrorNumber = '103' ;
		}
	}
	else
		$sErrorNumber = '102' ;

	// Create the "Error" node.
	echo '<Error number="' . $sErrorNumber . '" originalDescription="' . ConvertToXmlAttribute( $sErrorMsg ) . '" />' ;
}

function FileUpload( $resourceType, $currentFolder, $sCommand )
{
	if (!isset($_FILES)) {
		global $_FILES;
	}
	$sErrorNumber = '0' ;
	$sFileName = '' ;

	if ( isset( $_FILES['NewFile'] ) && !is_null( $_FILES['NewFile']['tmp_name'] ) )
	{
		global $Config ;

		$oFile = $_FILES['NewFile'] ;

		// Map the virtual path to the local server path.
		$sServerDir = ServerMapFolder( $resourceType, $currentFolder, $sCommand ) ;

		// Get the uploaded file name.
		$sFileName = filemanager_translit($oFile['name']);
		$sFileName = SanitizeFileName( $sFileName ) ;

		$sOriginalFileName = $sFileName ;

		// Get the extension.
		$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
		$sExtension = strtolower( $sExtension ) ;

		if ( isset( $Config['SecureImageUploads'] ) )
		{
			if ( ( $isImageValid = IsImageValid( $oFile['tmp_name'], $sExtension ) ) === false )
			{
				$sErrorNumber = '202' ;
			}
		}

		if ( isset( $Config['HtmlExtensions'] ) )
		{
			if ( !IsHtmlExtension( $sExtension, $Config['HtmlExtensions'] ) &&
				( $detectHtml = DetectHtml( $oFile['tmp_name'] ) ) === true )
			{
				$sErrorNumber = '202' ;
			}
		}

		// Check if it is an allowed extension.
		if ( !$sErrorNumber && IsAllowedExt( $sExtension, $resourceType ) )
		{
			$iCounter = 0 ;

			while ( true )
			{
				$sFilePath = $sServerDir . $sFileName ;

				if ( is_file( $sFilePath ) )
				{
					$iCounter++ ;
					$sFileName = RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
					$sErrorNumber = '201' ;
				}
				else
				{
					move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;

					if ( is_file( $sFilePath ) )
					{
						if ( isset( $Config['ChmodOnUpload'] ) && !$Config['ChmodOnUpload'] )
						{
							break ;
						}

						$permissions = 0777;

						if ( isset( $Config['ChmodOnUpload'] ) && $Config['ChmodOnUpload'] )
						{
							$permissions = $Config['ChmodOnUpload'] ;
						}

						$oldumask = umask(0) ;
						chmod( $sFilePath, $permissions ) ;
						umask( $oldumask ) ;
						
						if ($_POST['thumb'] && in_array($sExtension, array("gif", "jpg", "jpeg", "png", "wbmp"))) {
							filemanager_thumb($sFilePath, $_POST['thumb_x'], $_POST['thumb_y']);
            }

					}

					break ;
				}
			}

			if ( file_exists( $sFilePath ) )
			{
				//previous checks failed, try once again
				if ( isset( $isImageValid ) && $isImageValid === -1 && IsImageValid( $sFilePath, $sExtension ) === false )
				{
					@unlink( $sFilePath ) ;
					$sErrorNumber = '202' ;
				}
				else if ( isset( $detectHtml ) && $detectHtml === -1 && DetectHtml( $sFilePath ) === true )
				{
					@unlink( $sFilePath ) ;
					$sErrorNumber = '202' ;
				}
			}
		}
		else
			$sErrorNumber = '202' ;
	}
	else
		$sErrorNumber = '202' ;


	$sFileUrl = CombinePaths( GetResourceTypePath( $resourceType, $sCommand ) , $currentFolder ) ;
	$sFileUrl = CombinePaths( $sFileUrl, $sFileName ) ;

	SendUploadResults( $sErrorNumber, $sFileUrl, $sFileName ) ;

	exit ;
}

// SergiusD add

function FileDelete($resourceType, $currentFolder, $Command) {
	$sServerDir = ServerMapFolder( $resourceType, $currentFolder, $Command ) ;
	if (!unlink($sServerDir.$_GET['DelFile']))
		echo '<Error number="1" originalDescription="Ошибка при удалении файла" />' ;
}

function FolderDelete($resourceType, $currentFolder, $Command) {
	$sServerDir = ServerMapFolder( $resourceType, $currentFolder, $Command ) ;
	if (
		!filemanager_deldir($sServerDir.$_GET['DelFolder'].'/')
		|| !rmdir($sServerDir.$_GET['DelFolder'].'/')
	)
		echo '<Error number="1" originalDescription="Ошибка при удалении папки" />' ;
}

function filemanager_dirsize($dir,$size=0) {
	$hdl=opendir($dir);
	while (false !== ($file = readdir($hdl))) {
		if (($file != ".") && ($file != "..")) {
			if (is_dir($dir."/".$file)) {
				return filemanager_dirsize($dir."/".$file,$size);
			} else {
				$size += filesize($dir."/".$file);
			}
		}
	}
	closedir($hdl);
	return ceil($size/1024)." KB";
}

function filemanager_translit($input_string) {
	//$input_string = urldecode($input_string);
	$trans = array();
	$ch1 = "/\r\n-абвгдеёзийклмнопрстуфхцыэАБВГДЕЁЗИЙКЛМНОПРСТУФХЦЫЭABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $ch2 = "    abvgdeeziyklmnoprstufhcyeabvgdeeziyklmnoprstufhcyeabcdefghijklmnopqrstuvwxyz";
  for($i=0; $i<mb_strlen($ch1); $i++)
		$trans[mb_substr($ch1, $i, 1)] = mb_substr($ch2, $i, 1);
	$trans["Ж"] = "zh";  $trans["ж"] = "zh";
	$trans["Ч"] = "ch";  $trans["ч"] = "ch";
	$trans["Ш"] = "sh";  $trans["ш"] = "sh";
	$trans["Щ"] = "sch"; $trans["щ"] = "sch";
	$trans["Ъ"] = "";    $trans["ъ"] = "";
	$trans["Ь"] = "";    $trans["ь"] = "";
	$trans["Ю"] = "yu";  $trans["ю"] = "yu";
	$trans["Я"] = "ya";  $trans["я"] = "ya";
	$trans["\\\\"] = " ";
	$trans["[^\. a-z0-9]"] = " "; // контрольная проверка
	$trans["^[ ]+|[ ]+$"] = ""; // убираю пробелы вначале и конце
	$trans["[ ]+"] = "_"; // пробелы на подчеркивание
	foreach($trans as $from=>$to)
		$input_string = mb_ereg_replace(str_replace("\\", "\\", $from), $to, $input_string);
	return $input_string;
}

function filemanager_deldir($del) {
	$cont = glob($del."*");
	$ok = 1;
	foreach ($cont as $val) {
		if (is_dir($val)) {
			$ok *= filemanager_deldir($val."/");
			$ok *= rmdir($val)?1:0;
		} else {
			$ok *= unlink($val)?1:0;
		}
	}
	return $ok;
}

function filemanager_thumb($IMAGE_SOURCE, $THUMB_X, $THUMB_Y) {
	list($width, $height, $type, $attr) = getimagesize($IMAGE_SOURCE);
	if ($THUMB_Y < 0 || $THUMB_X < 0) {
		$THUMB_CUT = 1;
		$THUMB_Y = (int)abs($THUMB_Y);
		$THUMB_X = (int)abs($THUMB_X);
	} else {
		$THUMB_CUT = 0;
		$THUMB_Y = (int)$THUMB_Y;
		$THUMB_X = (int)$THUMB_X;
		$SRC_W = $width;
		$SRC_H = $height;
		$SRC_L = 0;
		$SRC_T = 0;
	}
	if ($THUMB_Y == 0 && $THUMB_X == 0) {
		$THUMB_Y = $height;
		$THUMB_X = $width;
	} elseif ($THUMB_Y == 0) {
		$THUMB_Y = (int)($height * ($THUMB_X / $width));
	} elseif ($THUMB_X == 0) {
		$THUMB_X = (int)($width * ($THUMB_Y / $height));
	} elseif ($THUMB_CUT) {
		// Если заданы оба и вырезать, то вырезаю из изображения прямоугольник
		$zoom_x = $width/$THUMB_X;
		$zoom_y = $height/$THUMB_Y;
		if ($zoom_x <= $zoom_y) {
			$SRC_W = $width;
			$SRC_H = (int)($THUMB_Y * $zoom_x);
			$SRC_L = 0;
			$SRC_T = ($height - $SRC_H) / 2;
		} elseif ($zoom_x > $zoom_y) {
			$SRC_W = (int)($THUMB_X * $zoom_y);
			$SRC_H = $height;
			$SRC_L = ($width - $SRC_W) / 2;
			$SRC_T = 0;
		}
	} else {
		// Если заданы оба, то вписываю в прямоугольник
		$zoom_x = $width/$THUMB_X;
		$zoom_y = $height/$THUMB_Y;
		if ($zoom_x >= $zoom_y) {
			$THUMB_Y = (int)($height * ($THUMB_X / $width));
		} elseif ($zoom_x < $zoom_y) {
			$THUMB_X = (int)($width * ($THUMB_Y / $height));
		}
	}

	// Если картинка меньше по обоим измерениям, то ничего не делаю
	if ($THUMB_X > $width && $THUMB_Y > $height) {
		return true;
	}

	$filter = (($SRC_L || $SRC_T)?'-crop '.$SRC_W.'x'.$SRC_H.'+'.$SRC_L.'+'.$SRC_T.'! ':'')."-resize ".$THUMB_X."x".$THUMB_Y;
	return exec('convert '.$IMAGE_SOURCE.' '.$filter.' '.$IMAGE_SOURCE)?false:true;
}

?>