<?php
namespace App\Dto;

class JsonResponse {

    private $response;

    // Constructor to initialize the response data
    public function __construct($response) {
        $this->response = $response;
    }

    public static $OK = "OK";
    public static $ERROR = "ERROR";

    public static function get($status, $Message, $returnData = null){
        return array(
            'status' => $status,
            'Message' => $Message,
            'Data' => $returnData,
        );
    }

    public static function validationErrorMessage($validator){
        $errors = array();
        $messages = $validator->errors();
        foreach($messages->all() as $message){
            array_push($errors, $message);
        }
        return JsonResponse::get(self::$ERROR, "Validation Error", array("errors"=>$errors));
    }

    public  static function safeEncode($value){
        if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
            $encoded = json_encode($value, JSON_PRETTY_PRINT);
        } else {
            $encoded = json_encode($value);
        }
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $encoded;
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_UTF8:
                $clean = self::utf8ize($value);
                return self::safeEncode($clean);
            default:
                return 'Unknown error'; // or trigger_error() or throw new
                Exception();
        }
    }

    public  static function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = self::utf8ize($value);
            }
        } else if (is_string ($mixed)) {
            return utf8_encode($mixed);
        }
        return $mixed;
    }

    public static function visitor($status, $message, $data = null): JsonResponse {
        return new self([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }

    // Implement the __toString() method to convert the response to a JSON string
    public function __toString() {
        return json_encode($this->response);
    }

    // Optional: A method to convert the response into an array, if needed
    public function toArray() {
        return $this->response;
    }

    public static function getDownloadTemplate($status, $headers = [], $content = null)
    {
        return response($content, $status, $headers);
    }


}
