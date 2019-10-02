<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="lightbox.js"></script>

    
</body>
</html>
<?php

// page name
$page = $_SERVER['PHP_SELF'];

// settings
$column = 4;

// directories
$base = "data";
$thumbs = "thumbs";

// get album
if(isset($_GET['album'])){
    $album = $_GET['album'];
    if(!$album) {
        echo "<strong>Select an album: </strong><p />";
        $handle = opendir($base);
        while(($file = readdir($handle)) !== false){
            if(is_dir($base."/".$file) && $file != "." && $file != ".." && $file != $thumbs) {
                echo "<a href='$page?album=$file'>".$file."</a><br />";
            }
        }
        closedir($handle);
    } else {
        if(!is_dir($base."/".$album) || (strstr($album, ".") != null) || (strstr($album, "/") != null) || (strstr($album, "\\") != null)){
            echo "<p>Album doesn't exist.</p>";
        } else {
            echo "<strong>" . $album . "</strong><p />";
            $x = 0;
            $handle = opendir($base . "/" . $album);
            while(($file = readdir($handle)) !== false){
                if($file != "." && $file != ".."){
                    echo "<table style = 'display:inline;'><tr><td><a href='$base/$album/$file' rel='lightbox'><img src='$base/$album/$file' height='100' widht='100'></a></td></tr></table>";
                    $x++;
    
                    if($x == $column)
                    {
                        $x = 0;
                        echo "<br />";
                    }
                }
            }
            closedir($handle);
        }
        echo "<p /><a href='$page'>Back to albums</a>";
    }
    
} else {
    echo "<strong>Select an album: </strong><p />";
        $handle = opendir($base);
        while(($file = readdir($handle)) !== false){
            if(is_dir($base."/".$file) && $file != "." && $file != ".." && $file != $thumbs) {
                echo "<a href='$page?album=$file'>".$file."</a><br />";
            }
        }
        closedir($handle);
}
?>
</head>
<body>