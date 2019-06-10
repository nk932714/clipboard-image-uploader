<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.responsive {
    width: 100%;
    max-width: 300px;
    height: auto;
}
a.hola:link, a.hola:visited {
    background-color: #f44336;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}
a.hola:hover, a.hola:active {
    background-color: red;
}

</style>
</head>
<body>
    
    
    
    
<?php
if (!file_exists('upload')) {
    mkdir('upload', 0777, true);
}

/**************** deleting file *************/
 if (isset($_GET['delete'])) { 	     	
    $data=$_GET["delete"];
    $file1 = basename($data);
    $dir="upload";
    $dirHandle = opendir($dir);
    while ($file = readdir($dirHandle)) {
                                         if($file==$file1) {
                                                    unlink($dir.'/'.$file);
                                         }
                                         else { /*echo "error reading file";*/ }
    }
} 

/*********** list dir images *********/
$dirname = "upload/";
$images = glob($dirname."*.png");

foreach($images as $image) {
    echo '<img src="'.$image.'" alt="broken img" class="responsive" width="200" height="150" / >';
    echo '<br><a href="'.$image.'">View Full Image</a>&emsp;&emsp;';
    echo '<a href="?delete='.$image.'">Delete</a><br>';
}

/**********scan by img uploaded date *************/
/* 
print_r(scan_dir("upload/"));

function scan_dir($dir) {
    $ignored = array('.', '..', '.svn', '.htaccess');

    $files = array();    
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false; 
}
*/
/**********scan by img uploaded date end *************/
