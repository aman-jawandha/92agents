<?php

namespace App\Helper;

// use \Illuminate\Http\Response;
// use \Illuminate\Contracts\Routing\ResponseFactory;

use Illuminate\Http\Response;
use Illuminate\Contracts\Routing\ResponseFactory;

class Resp
{
    // Success (1xx)
    const OK = 100;
    const CREATED = 101;
    const ACCEPTED = 102; // For asynchronous processing
    const UPDATED = 103; // For asynchronous processing

    // Client Errors (2xx)
    const GENERAL_CLIENT_ERROR = 200;
    const VALIDATION_ERROR = 201;
    const MISSING_REQUIRED_FIELD = 202;
    const INVALID_FORMAT = 203;
    const INVALID_INPUT_DATA = 204;
    const RESOURCE_ALREADY_EXISTS = 205;
    const AUTHENTICATION_ERROR = 210;
    const AUTHORIZATION_ERROR = 211;
    const PERMISSION_DENIED = 212;
    const RATE_LIMIT_EXCEEDED = 220;
    const HEADER_ERROR = 230;
    const UNSUPPORTED_MEDIA_TYPE = 240;

    // Server Errors (3xx)
    const GENERAL_SERVER_ERROR = 300;
    const DATABASE_ERROR = 301;
    const EXTERNAL_SERVICE_ERROR = 302;
    const TIMEOUT = 303;
    const INTERNAL_SERVICE_ERROR = 304;
    const RESOURCE_NOT_FOUND = 310;
    const RESOURCE_GONE = 311; // Resource no longer exists 

    // Business Logic Errors (4xx)
    const GENERAL_BUSINESS_LOGIC_ERROR = 400;
    const INSUFFICIENT_FUNDS = 401;
    const ORDER_CANNOT_BE_PROCESSED = 402;
    const ACCOUNT_INACTIVE = 403;

    // System Errors (9xx)
    const UNKNOWN_ERROR = 900;
    const SYSTEM_MAINTENANCE = 901;

    // Common Messages
    const MESSAGE_FETCHED = "Records Fetched Succesfully";
    const MESSAGE_FETCHED_SINGLE = "Record Fetched Succesfully";

    const MESSAGE_ADDED = "Records Added Succesfully";
    const MESSAGE_ADDED_SINGLE = "Record Added Succesfully";

    const MESSAGE_UPDATED = "Records Updated Succesfully";
    const MESSAGE_UPDATED_SINGLE = "Record Updated Succesfully";

    const MESSAGE_DELETED = "Records Deleted Succesfully";
    const MESSAGE_DELETED_SINGLE = "Record Deleted Succesfully";
    
    // Data Not Found/Missing Messages
    const MESSAGE_NO_RECORDS = "No records found!";
    const MESSAGE_NO_RECORDS_SINGLE = "Record not found!";
    const MESSAGE_DATA_MISSING = "Required data is missing!";
    const MESSAGE_INCOMPLETE_DATA = "Incomplete data provided!";

    static function Api($data = [], $message = "Completed Succesfully!", $need_count = FALSE, $count = NULL, $has_paginate = FALSE, $misc = [], $errors = [], $rc = 200, $code = 100)//: Response|ResponseFactory
    {
        if ($has_paginate) {
            if(gettype($data) == 'object')
            $data = $data->toArray();

            if (isset($data["current_page"])) {
                $arr_data = $data['data'];
                unset($data['data']);
                $Paginate = $data;
                $data = $arr_data;
            }
        }

        $response = [
            "status" => TRUE,
            "message" => $message,
            "code" => $code,
            "data" => $data,
            "misc" => $misc,
            "errors" => $errors,
        ];

        if ($has_paginate) {
            $response["paginate"] = $Paginate;
        }

        if ($need_count) {
            $response["misc"]["count"] = ($count !== NULL) ? $count : count($response["data"]);
        } else {
            unset($response["misc"]["count"]);
        }

        return response()->json($response, $rc);
    }

    static function BadApi($message = "Oops! Something went wrong...", $errors = [], $data = [], $misc = [], $code = 300, $rc = 500)//: Response|ResponseFactory
    {
        $response = [
            "status" => FALSE,
            "message" => $message,
            "code" => $code,
            "data" => $data,
            "misc" => $misc,
            "errors" => $errors,
        ];

        return response()->json($response, $rc);
    }

    static function InvalidRequest($errors = [], $data = [], $misc = [], $message = "Invalid Data!", $rc = 422, $validator = null)//: Response|ResponseFactory
    {
        if($validator && $validator instanceof \Illuminate\Validation\Validator)
        return self::BadApi("Data Validation Failed!", $validator->errors(), $validator->getData(), [], self::VALIDATION_ERROR, $rc);
        // $validator->errors()->all()

        return self::BadApi($message, $errors, $data, $misc, self::VALIDATION_ERROR, $rc);
    }

    static function NoAuth($AuthType = "User")//: Response|ResponseFactory
    {
        return self::BadApi("$AuthType Authentication Failed!", [], [], [], self::AUTHENTICATION_ERROR, 401);
    }

    static function Array($data = [], $message = "Completed Succesfully!", $need_count = TRUE, $count = 0, $misc = [], $code = 100, $redirect = NULL): Response|ResponseFactory
    {
        $response = [
            "status" => 1,
            "count" => 0,
            "message" => $message,
            "data" => $data,
            "misc" => $misc,
            "redirect" => $redirect,
        ];

        if ($need_count) {
            $response["count"] = $count ?: count($response["data"]);
        } else {
            unset($response["count"]);
        }

        // return $Response;
        return response($response, 200);
    }

    static function BadArray($message = "Completed Succesfully!", $data = [], $misc = [], $rc = 500, $code = 300, $redirect = NULL)//: Response|ResponseFactory
    {
        $response = [
            "status" => 0,
            "message" => $message,
            "data" => $data,
            "misc" => $misc,
            "redirect" => $redirect,
        ];

        return response($response, $rc);
    }

    function Help(): Response|ResponseFactory {
        // Get all constants from the Resp class
        $reflection = new \ReflectionClass('Resp');
        $constants = $reflection->getConstants();
      
        // Create an associative array in the desired format
        $responseCodes = [];
        foreach ($constants as $name => $value) {
          $responseCodes[$value] = str_replace('_', ' ', $name); 
        }
      
        // Return the data as JSON
        return response($responseCodes, 200);
      }

    static function check_status(array $response): bool
    {
        return $response["status"] ? TRUE : FALSE;
    }

    static function DecodeData(array $response)
    {
        return $response["status"] ?
            response($response["data"], 200) :
            response($response["data"], 500);
    }

    static function DecodeMisc(array $response)
    {
        return $response["status"] ?
            response($response["misc"], 200) :
            response($response["misc"], 500);
    }

    static function check_stat($response)
    {
        if (!isset($status["status"]))
            return false;

        $status = $response["status"] ?? 0;
        $code = $response["code"] ?? 0;
        $status = $response["status"] ?? 0;
        $message = $response["message"] ?? "Sorry.. Something not right!";
        if (!$status)
            return $message ?? false;

        return true;
    }

    static function check_count($response)
    {
        if (!isset($status["count"]))
            return true;

        $count = $response["count"] ?? 0;

        if (!$count)
            return "No data found!";

        return $count;
    }

    static function fetch_data($response)
    {
        return $response["data"] ?? [];
    }

    static function get_data($response)
    {
        $stat = self::check_stat($response);
        $count = self::check_count($response);

        if (!$stat)
            return $stat;
        if (!$count)
            return $count;

        return self::fetch_data($response);
    }
}
