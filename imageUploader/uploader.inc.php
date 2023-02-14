<?php

/*
Important

First, ensure that PHP is configured to allow file uploads.
In your "php.ini" file, search for the file_uploads directive, and set it to On:

*/


function deletefilesAtUpdate($ImgPathsToDel){
  $deletedFiles=array();
  foreach ($ImgPathsToDel as $path) {
    if($path!=""){
      $path_arr=explode("/",$path);
      $path_arr=array_reverse($path_arr);
      $pathtodir = getcwd()."\\".$path_arr[1]."\\".$path_arr[0];
      $del=unlink($pathtodir);
      if($del){
        $path=$path_arr[1]."/".$path_arr[0];
        array_push($deletedFiles,$path);
      }
    }
  }
  return  $deletedFiles;
}

//fileset is always $_FILES
function upload($uploadboxnames,$imgnamePrifix,$fileset){
  $uploadpath=array();
  foreach ($uploadboxnames as $uploadbox) {
    //Check If file has uploaded
    if (empty($fileset[$uploadbox]['name'])) {
      //no file
      continue;
    }

    $target_dir = "uploads/";
    $path = $fileset[$uploadbox]['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $target_file = $target_dir.$imgnamePrifix.$uploadbox.".".$ext;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($fileset[$uploadbox]["tmp_name"]);
    if($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    }
    else {
      //echo "File is not an image.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      echo "Sorry, only JPG, JPEG, PNG files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
      if (move_uploaded_file($fileset[$uploadbox]["tmp_name"], $target_file)) {
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        array_push($uploadpath, $target_file);
      }
    }
  }
  return $uploadpath;
}





/*when update
  -load all files to file boxes
  -overwrite files from form boxes
  -update databse
*/
?>