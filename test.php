<?php
function listDir($dir)
{
    if(is_dir($dir))
    {
        if($dh = opendir($dir))
        {
            while(($file = readdir($dh)) !== false)
            {
				if($file == '.svn')
					removeDir($dir."/.svn/");
				elseif(is_dir($dir."/".$file)) && $file != "." && $file != "..")
					listDir($dir."/".$file);
					
            closedir($dh);
        }
    }
}

function removeDir($dirName) 
{ 
    if(! is_dir($dirName)) 
    { 
        return false; 
    } 
    $handle = @opendir($dirName); 
    while(($file = @readdir($handle)) !== false) 
    { 
        if($file != '.' && $file != '..') 
        { 
            $dir = $dirName . '/' . $file; 
            is_dir($dir) ? removeDir($dir) : @unlink($dir); 
        } 
    } 
    closedir($handle); 
    return rmdir($dirName) ; 
}

$dir = __DIR__;
listDir($dir);