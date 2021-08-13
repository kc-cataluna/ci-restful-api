<?php

namespace App\Services;

class Service
{
    protected $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    protected function handleGetRequest($endpoint, $data = [])
    {
        $query = http_build_query($data);

        $endpoint .= '?' . $query;

        curl_setopt($this->curl, CURLOPT_URL, $endpoint);

        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, GET_REQUEST);

        return $this->curl;
    }

    protected function handlePostRequest($endpoint, $data = [])
    {
        $value = http_build_query($data);

        curl_setopt($this->curl, CURLOPT_URL, $endpoint);

        curl_setopt($this->curl, CURLOPT_POST, 1);

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $value);

        return $this->curl;
    }

    protected function httpRequest($endpoint, $data = [], $apiKey, $method = GET_REQUEST)
    {
        switch ($method) {
            case GET_REQUEST:
                $curl = $this->handleGetRequest($endpoint, $data);
                break;
            case POST_REQUEST:
                $curl = $this->handlePostRequest($endpoint, $data);
                break;
            default:
                return (object) SOMETHING_WENT_WRONG;
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            "x-api-key: $apiKey",
        ]);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        curl_close($curl);

        // Remove all non printable characters in the string
        // https://stackoverflow.com/questions/2410342/php-json-decode-returns-null-with-valid-json
        // https://stackoverflow.com/questions/1176904/how-to-remove-all-non-printable-characters-in-a-string
        // Example: echo utf8_encode($result); // See the non printable characters
        $replaced = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result);

        $response = json_decode($replaced);

        if ($response === null) {
            return (object) SOMETHING_WENT_WRONG;
        }

        if (isset($response->error) && strpos($response->error, 'Unauthorized') > -1) {
            return (object) UNAUTHORIZED;
        }

        return $response;
    }
}