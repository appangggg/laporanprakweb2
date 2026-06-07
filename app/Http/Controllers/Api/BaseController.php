<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller {

    protected function success($data = null, $message = null, $code = 200) {
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ], $code);
    }

    protected function error($message = null, $code = 400) {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}