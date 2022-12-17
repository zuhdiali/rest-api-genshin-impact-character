<?php

function akses_restapi($method, $url, $data)
{
    $client = \Config\Services::curlrequest();
    $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6IjEyMzQ1NkBnbWFpbC5jb20iLCJpYXQiOjE2NjU4NDIzMDUsImV4cCI6MTY2NTg0NTkwNX0.e065Bxmd9q2yAy25d0-M-J0QR70hdb5tThPT_zmm0kc";

    $headers = [
        'Authorization' => 'Bearer ' . $token
    ];

    $response = $client->request($method, $url, ['headers' => $headers, 'http_errors' => false, 'form_params' => $data]);

    return $response->getBody();
}
