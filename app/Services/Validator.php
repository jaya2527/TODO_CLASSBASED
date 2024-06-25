<?php

namespace app\Services;

use utils\Util;


class Validator
{

    private $errors = [];
    private $data = [];
    private $type;


    public static $patterns = [
        'first_name' => [
            'pattern' => '/^[a-zA-Z]+$/',
            'message' => 'First Name only letters and white space allowed'
        ],

        'last_name' => [
            'pattern' => '/^[a-zA-Z]+$/',
            'message' => 'Last Name only letters and white space allowed'
        ],
        'username' => [
            'pattern' => '/^[a-zA-Z]+$/',
            'message' => 'Username only letters and white space allowed'
        ],
        'phone_number' => [
            'pattern' => "/^[0-9]{10}+$/",
            'message' => 'Phone number is not valid'
        ],

        'password' => [
            'pattern' => "#[A-Z]+#",
            'message' => "Password Is Wrong Match"
        ]

    ];

    public function __construct($data, $type, $files = [])
    {
        $this->data = $data;
        $this->type = $type;
        $this->files = $files;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validate()
    {

        if (isset($this->files['file'])) {
            $file_response = self::fileValidate($this->files['file']);
            if ($file_response['error']) {
                $this->errors['file'] = $file_response['message'];
            }
        }
        foreach ($this->data as $key => $value) {
            if (empty($value)) {
                $this->errors[$key] = Util::formatFieldKey($key) . " is Required";
            } elseif (isset(self::$patterns[$key]['pattern']) && !preg_match(self::$patterns[$key]['pattern'], $value)) {
                $this->errors[$key] = self::$patterns[$key]['message'];
            }
        }
        return $this->errors;
    }
    public static function fileValidate($file)
    {
        $response = [];

        if (empty($file['name'])) {
            $response['error'] = true;
            $response['message'] = "Profile is required";
            return $response;
        }

        if ($file["size"] > 500000) {
            $response['error'] = true;
            $response['message'] = "Sorry your file is too large";
            return $response;
        }

        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            $response['error'] = true;
            $response['message'] = "Sorry only jpeg, jpg, png, & GIF files are required";
            return $response;
        }
        return [
            'error' => false
        ];
    }


    public function handleTaskValidator($type)
    {
        switch ($type) {
            case 'add_task':
                if (empty($this->data['task'])) {
                   $this->errors['task'] = "Task is required";
                }
                break;

            case 'update_task':
                if (empty($this->data["task"]) || empty($this->data["task_id"])) {

                    $id= $this->data["task_id"] ;

                    $this->errors['update_task'][$id] ="Update is required";
                }
                break;


            case 'delete_task':
                if (!isset($this->data["id"]) || empty($this->data["id"])) {
                    $this->errors['delete_task']= "ID is required";
                }
                break;

            default:

        }
        return $this-> errors;
    }

}


