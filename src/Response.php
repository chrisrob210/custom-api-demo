<?php

/**
 * Generates a Response
 * 
 * @param string|mixed|array $content
 * @param number $responseCode
 * @param string $responseDescription
 * 
 * @return void
 */
function response($content, $responseCode = 200, $responseDescription = "success")
{
    header("HTTP/1.1 $responseCode $responseDescription");
    header("Content-Type:application/json");
    $response['content'] = $content;
    $json_response = json_encode($response);
    echo $json_response;
}