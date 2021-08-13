<?php

use chriskacerguis\RestServer\RestController;
use App\Services\OrderService;
use App\Traits\SendResponse;

class Api extends RestController
{
    use SendResponse;

    protected $order;

    public function __construct()
    {
        parent::__construct();
        $this->order = new OrderService;
    }

    public function orders_get()
    {
        $response = $this->order->all();

        if (false === $response->success) {
            return $this->sendFailedResponse($response);
        }

        return $this->sendSuccessResponse($response);
    }

    public function orders_post()
    {
        // (Postman) Please choose x-www-form-urlencoded instead of form-data in getting the data
        // https://github.com/chriskacerguis/codeigniter-restserver/issues/641#issuecomment-213689125

        $response = $this->order->create();

        if (false === $response->success) {
            return $this->sendFailedResponse($response);
        }

        return $this->sendSuccessResponse($response);
    }

    public function orders_patch()
    {
        // (Postman) Please choose x-www-form-urlencoded instead of form-data in getting the data
        // https://github.com/chriskacerguis/codeigniter-restserver/issues/641#issuecomment-213689125

        $id = end($this->uri->segments);

        $response = $this->order->update($id);

        if (false === $response->success) {
            return $this->sendFailedResponse($response);
        }

        return $this->sendSuccessResponse($response);
    }
}