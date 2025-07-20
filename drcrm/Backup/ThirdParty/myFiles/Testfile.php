<?php
function TestMyFile(){
    echo  "TEst My File Done";
}
#################################################################################################################################
###################################################    
#################################################################################################################################
function print_r99($val) {
    echo '<div style="float: left; width: 400px;">';
    echo '<pre>';
    print_r($val);
    echo '</pre>';
    echo '</div>';
}
#################################################################################################################################
###################################################    
#################################################################################################################################
function MySQLBackup_ZipTypeIs($Type){
    switch($Type) {
        case "sql":
            $ZipType = "sql";
            $Extension = ".sql";
            break;
        case "zip":
            $ZipType = "zip";
            $Extension = ".zip";
            break;

        case "gz":
            $ZipType = "gz";
            $Extension = ".sql.gz";
            break;

        case "gzip":
            $ZipType = "gzip";
            $Extension = ".sql.gz";
            break;
        default:
            $ZipType = "zip";
            $Extension = ".zip";
    }
    return  array("ZipType" => $ZipType ,"Extension"=>$Extension ) ;
}
#################################################################################################################################
###################################################    
#################################################################################################################################
//zipData(FULL_SOURS_PHOTO_DIR, BACK_PHOTO_FOLDER."hany.zip");
function zipData($source, $destination) {
	if (extension_loaded('zip')) {
		if (file_exists($source)) {
			$zip = new ZipArchive();
			if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
				$source = realpath($source);
				if (is_dir($source)) {
					$iterator = new RecursiveDirectoryIterator($source);
					// skip dot files while iterating 
					$iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
					$files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
						$file = realpath($file);
						if (is_dir($file)) {
							$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
						} else if (is_file($file)) {
							$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
						}
					}
				} else if (is_file($source)) {
					$zip->addFromString(basename($source), file_get_contents($source));
				}
			}
			return $zip->close();
		}
	}
	return false;
}

#################################################################################################################################
###################################################    FileTYpeName
#################################################################################################################################

function FileTYpeName($state) {
    global $AdminLangFile ;
   switch($state) {
     case "1":
       $order = $AdminLangFile['backup_manually'];
       break;
     case "2":
       $order =  $AdminLangFile['backup_automatic'];
       break;
     default:
       $order = ' ';
   }
   return $order;
}

#################################################################################################################################
###################################################    
#################################################################################################################################


//createZip(FULL_SOURS_PHOTO_DIR, BACK_PHOTO_FOLDER."hany55.zip");
function createZip($dirSource,$dirBackup, $reload = null, $oZip = null) {
    // si le dossier existe
    if ($dir = opendir($dirSource)) {
        // on créait le chemin du dossier final
        $pathZip = substr($dirBackup, 0, -1).'.zip';
        //si la fonction est lancé pour la première fois on créait l'objet
        if(!$reload){
            $oZip = new ZipArchive;
            $oZip->open($pathZip, ZipArchive::CREATE);
        }// sinon on récupère l'object passé en param
        else{
            $oZip = $oZip;
        }
        
        while (($file = readdir($dir)) !== false) {
            // on évite le dossier parent et courant
            if($file != '..'  && $file != '.') {
                // Si c'est un dossier on relance la fonction
                if(is_dir($dirSource.$file)) {
                    createZip($dirSource.$file.'/', $dirBackup.$file.'/', 1, $oZip);
                }// sinon c'est un fichier donc on l'ajoute à l'archive
                else {
                    $oZip->addFile($dirSource.$file);
                }
            }
        }
        // on ferme l'archive
        if(!$reload){
            return $oZip->close();
        }
    }
}
#################################################################################################################################
###################################################    Class HZip 
#################################################################################################################################
class HZip {
	private static function folderToZip($folder, &$zipFile, $exclusiveLength) {
		$handle = opendir($folder);
		while ($f = readdir($handle)) {
			if ($f != '.' && $f != '..') {
				$filePath = "$folder/$f";
				// Remove prefix from file path before add to zip.
				$localPath = substr($filePath, $exclusiveLength);
				if (is_file($filePath)) {
					$zipFile->addFile($filePath, $localPath);
				} elseif (is_dir($filePath)) {
					// Add sub-directory.
					$zipFile->addEmptyDir($localPath);
					self::folderToZip($filePath, $zipFile, $exclusiveLength);
				}
			}
		}
		closedir($handle);
	}
	
	public static function zipDir($sourcePath, $outZipPath) {
		$pathInfo = pathInfo($sourcePath);
		$parentPath = $pathInfo['dirname'];
		$dirName = $pathInfo['basename'];
		
		$z = new ZipArchive();
		$z->open($outZipPath, ZIPARCHIVE::CREATE);
		$z->addEmptyDir($dirName);
		self::folderToZip($sourcePath, $z, strlen("$parentPath/"));
		$z->close();
	}
}




?>