<?php 
use Symfony\Component\Yaml\Yaml;
header('Content-type: application/json');
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
try {
    require_once __DIR__ . '/vendor/autoload.php';
    
} catch (Exception $ex) {
    http_response_code(500);
    $rsp = array(
        "code" => 500,
        "error" => "The server is not ready to handle the request.",
        "message" => "Failed to import vendors: ".$ex
    );
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
if (!is_writable(__DIR__)) {
    http_response_code(500);
    $rsp = array(
        "code" => 500,
        "error" => "The server is not ready to handle the request.",
        "message" => "We have no write permission for our home directory. Please update the permission by executing this in the server shell: chown -R www-data:www-data /var/www/MythicalPics-Daemon/ && chown -R www-data:www-data /var/www/MythicalPics-Daemon/*"
    );
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
require("functions/https.php");
if (!isHTTPS()) {
    http_response_code(500);
    $rsp = array(
        "code" => 500,
        "error" => "The server is not ready to handle the request.",
        "message" => "We are sorry but you can't use the daemon on http:// please use https://"
    );
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
} 
?>