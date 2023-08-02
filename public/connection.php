<?php 
include(__DIR__.'/../base.php'); 
if (isset($_GET['auth_key'])) {
    if (!$_GET['auth_key'] == "") {
        $key = $_GET['auth_key'];
        $node = $config['node'];
        $node_key = $node['panel_key'];
        if ($key == $node_key) {
            $rsp = array(
                "code" => 200,
                "error" => null,
                "message" => "The key is valid."
            );
            http_response_code(200);
            die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        } else {
            $rsp = array(
                "code" => 403,
                "error" => "The server understood the request, but it refuses to authorize it.",
                "message" => "We can't connect you since the auth key is not the same!"
            );
            http_response_code(403);
            die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
    } else {
        $rsp = array(
            "code" => 400,
            "error" => "The server cannot understand the request due to a client error.",
            "message" => "Please provide a auth key"
        );
        http_response_code(400);
        die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
} else {
    $rsp = array(
        "code" => 400,
        "error" => "The server cannot understand the request due to a client error.",
        "message" => "Please provide a auth key"
    );
    http_response_code(400);
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
?>