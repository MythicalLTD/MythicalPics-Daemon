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
        "message" => "Faild to import vendors: ".$ex
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
try {
    $file = '../config.yml';
    if (!file_exists($file)) {
        $data = [
            'node' => [
                'panel_url' => 'https://your_mythical_pics_install.net',
                'panel_key' => '<strongkey>'
            ],
            'database' => [
              'host' => '',
              'port' => '3306',
              'username' => 'MythicalSystems',
              'password' => '<password>',
              'database' => 'MythicalPics-Daemon',
            ],
            'ssh' => [
                'host' => 'localhost',
                'port' => '22',
                'username' => 'MythicalSystems',
                'password' => ''
            ]
          ];
          $yaml = Yaml::dump($data);
          file_put_contents($file, $yaml);
    } else {
        include(__DIR__."/include/settings.php");
    }
}
catch (Exception $ex) {
    http_response_code(500);
    $rsp = array(
        "code" => 500,
        "error" => "The server is not ready to handle the request.",
        "message" => "Faild to import settings from config.yml: ".$ex
    );
    die(json_encode($rsp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
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