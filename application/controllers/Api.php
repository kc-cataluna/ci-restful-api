<?php

use chriskacerguis\RestServer\RestController;
use App\Services\OrderService;
use App\Traits\SendResponse;
use Pusher\Pusher;

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

    public function auth_pusher_post()
    {
        $options = [
            'cluster' => PUSHER_APP_CLUSTER,
        ];

        $pusher = new Pusher(PUSHER_APP_KEY, PUSHER_APP_SECRET, PUSHER_APP_ID, $options);

        $channel_name = $this->input->post('channel_name');
        $socket_id = $this->input->post('socket_id');

        echo $pusher->presence_auth($channel_name, $socket_id, '');
    }
}