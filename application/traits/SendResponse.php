<?php

namespace App\Traits;

trait SendResponse
{
    public function sendSuccessResponse($response)
    {
        return $this->response(
            [
                'success' => true,
                'data'    => $response->data,
            ],
            self::HTTP_OK
        );
    }

    public function sendFailedResponse($response)
    {
        return $this->response(
            [
                'success' => false,
                'error'   => $response->error,
            ], 
            $response->status
        );
    }
}