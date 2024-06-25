<?php
namespace utils;
class Util
{
    public static function redirect($pageName, $queryParameters = '')
    {
        $url = "Location:/" . $pageName . ".php";
        if (!empty($queryParameters)) {
            $url = $url . '?' . $queryParameters;
        }
        header($url);
        exit;
    }

    public static function formatFieldKey($fieldKey)
    {
        //remove underscore
        return str_replace('_', ' ', ucfirst($fieldKey));
    }

    public static function upload($file)
    {
        $uploads_dir = "./uploads/";
        $filename = pathinfo($file["name"], PATHINFO_FILENAME);
        $timestamp = date("YmdHis");
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $uploadFile = $uploads_dir . $filename . '_' . $timestamp . '.' . $imageFileType;

        if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
            return [
                'error' => false,
                "path" => $uploadFile
            ];
        }

        return [
            'error' => true,
            "message" => "File not uploaded"
        ];
    }
}



