<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use chriskacerguis\RestServer\RestController;

class API_Controller extends RestController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function generateToken($user)
    {
        $payload = array(
            'uid' => base64_encode($user->id),
        );

        $jwt = JWT::encode($payload, JWT_KEY);

        return $jwt;
    }

    public function verifyToken($message)
    {
        $authHeader = $this->input->get_request_header('Authorization');
        $arr = explode(" ", $authHeader);
        if (count($arr) > 1) {
            $token = $arr[1];

            try {
                JWT::$leeway = 60; // $leeway in seconds
                $decoded = JWT::decode($token, JWT_KEY, array('HS256'));
                return base64_decode($decoded->uid);
                
            } catch (\Exception $e) { // Also tried JwtException
                $message['message'] = 'Unauthorized';
                $this->response($message, RestController::HTTP_UNAUTHORIZED);
            }
        } else {
            $message['message'] = 'Unauthorized';
            $this->response($message, RestController::HTTP_UNAUTHORIZED);
        }
    }

}
