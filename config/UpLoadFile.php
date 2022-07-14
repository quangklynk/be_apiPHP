<?php

class UpLoadFile
{
    public function upload($fileName, $tempPath, $fileSize, $path)
    {
        if (empty($fileName)) {
            $errorMSG = json_encode(array("message" => "please select image", "status" => false));
            echo $errorMSG;
        } else {

            $UPLOAD_PATH = $path;

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

            if (in_array($fileExt, $valid_extensions)) {
                if (!file_exists($UPLOAD_PATH . $fileName)) {
                    if ($fileSize < 5000000) {
                        move_uploaded_file($tempPath, $UPLOAD_PATH . $fileName);
                    } else {
                        $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
                        echo $errorMSG;
                    }
                } else {
                    $errorMSG = json_encode(array("message" => "Sorry, file already exist check upload folder", "status" => false));
                    echo $errorMSG;
                }
            } else {
                $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG, & GIF file are allowed", "status" => false));
                echo $errorMSG;
            }
        }
    }
}
