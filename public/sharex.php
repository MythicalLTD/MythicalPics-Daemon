<?php 
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
require_once(__DIR__.'/../config.php');

include(__DIR__.'/../base.php');
$api_key = $_GET['api_key'];
if (isset($api_key)) {
    $client = new Client();
    try {
        $response = $client->get($_CONFIG['panel_url'], [
            'query' => ['api_key' => $api_key],
        ]);
    } catch (RequestException $e) {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();

            $data = json_decode($response->getBody(), true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $rsp = array(
                    "code" => 500,
                    "error" => "The server understood the request, but it refuses to authorize it.",
                    "message" => $data['message']
                );
                http_response_code(500);
                die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            } else {
                $rsp = array(
                    "code" => 500,
                    "error" => "The server understood the request, but it refuses to authorize it.",
                    "message" => $response->getReasonPhrase() 
                );
                http_response_code(500);
                die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            }
        } else {
            $rsp = array(
                "code" => 500,
                "error" => "The server understood the request, but it refuses to authorize it.",
                "message" => $e->getMessage()
            );
            http_response_code(500);
            die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
    }
} else {
    $rsp = array(
        "code" => 403,
        "error" => "The server understood the request, but it refuses to authorize it.",
        "message" => "We can't create a sharex config because we don't have a api key to look for the user in the database."
    );
    http_response_code(403);
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
?>