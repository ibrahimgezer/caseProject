<?php
if (!function_exists('display_error')) {
    function display_error($validation, $field)
    {
        if ($validation->hasError($field)) {
            return $validation->getError($field);
        } else {
            return false;
        }
    }
}

if (!function_exists('uploadMedia')) {
    function uploadMedia($file, $savePath, $currentImage = null)
    {
        if (!is_dir($savePath)) {
            mkdir($savePath, 0777, true);
        }
        if (!empty($file->getName())) {
            $imageName = $file->getRandomName();
            $mimeType = $file->getMimeType();
            if (strpos($mimeType, 'image/') === 0) {
                if ($currentImage && file_exists($savePath . $currentImage)) {
                    deleteMedia($savePath, $currentImage);
                }
                $file->move($savePath, $imageName);
                if (!$file->hasMoved()) {
                    $file->move($savePath, $imageName);
                }
            } else {
                $imageName = $currentImage;
            }
        } else {
            $imageName = $currentImage;
        }
        return $imageName;
    }
}

if (!function_exists('deleteMedia')) {
    function deleteMedia($savePath, $getImage)
    {
        $filePath = $savePath . $getImage;
        if (file_exists($filePath) && $getImage !=null) {
            unlink($filePath);
        }
    }
}

if (!function_exists('getUserData')) {
    function getUserData($userID)
    {
        $userModel = model("userModel");
        return $userModel->where(['id' => $userID])->first();
    }
}

function md5_decode($hashedText): string
{
    return hash('md5', $hashedText);
}
